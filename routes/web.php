<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalTicketController;
use App\Models\GoalTicket;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $matches = GoalTicket::query()
        ->where('status', 'AVAILABLE')
        ->orderByDesc('featured')
        ->orderBy('match_at')
        ->get();

    return view('welcome', compact('matches'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $matches = GoalTicket::query()
            ->orderByDesc('featured')
            ->orderBy('match_at')
            ->get();

        $upcomingMatches = GoalTicket::query()
            ->where('match_at', '>=', now())
            ->orderBy('match_at')
            ->take(5)
            ->get();

        $featuredMatch = GoalTicket::query()
            ->where('match_at', '>=', now())
            ->orderByDesc('featured')
            ->orderBy('match_at')
            ->first();

        $stats = [
            'total' => $matches->count(),
            'available' => $matches->where('status', 'AVAILABLE')->count(),
            'featured' => $matches->where('featured', true)->count(),
            'leagues' => $matches->pluck('league')->filter()->unique()->count(),
        ];

        return view('dashboard', compact('upcomingMatches', 'featuredMatch', 'stats'));
    })->name('dashboard');
    
    Route::get('/users', function () {
        return view('users');
    })->name('users');
    
    Route::get('/addusers', function () {
        return view('adduser');
    })->name('addusers');

    Route::get('/edit', function () {
        return view('edit');
    })->name('edit');

    Route::get('/edituser/{id}', function ($id) {
        return view('edituser', compact('id'));
    })->name('edituser');

    Route::resource('goal-tickets', GoalTicketController::class);
});
// 555