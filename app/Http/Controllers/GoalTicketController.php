<?php

namespace App\Http\Controllers;

use App\Models\GoalTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GoalTicketController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $goalTickets = GoalTicket::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('league', 'like', "%{$search}%")
                        ->orWhere('home', 'like', "%{$search}%")
                        ->orWhere('away', 'like', "%{$search}%")
                        ->orWhere('stadium', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('featured')
            ->orderBy('match_at')
            ->paginate(10)
            ->withQueryString();

        return view('goal-tickets.index', [
            'goalTickets' => $goalTickets,
            'search' => $search,
            'total' => GoalTicket::count(),
            'available' => GoalTicket::where('status', 'AVAILABLE')->count(),
            'featured' => GoalTicket::where('featured', true)->count(),
        ]);
    }

    public function create(): View
    {
        return view('goal-tickets.form', [
            'goalTicket' => new GoalTicket(),
            'heading' => 'เพิ่มแมตช์ใหม่',
            'submitLabel' => 'บันทึกแมตช์',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $goalTicket = GoalTicket::create($this->validatedData($request));

        return redirect()
            ->route('goal-tickets.show', $goalTicket)
            ->with('success', 'เพิ่มแมตช์เรียบร้อยแล้ว');
    }

    public function show(GoalTicket $goalTicket): View
    {
        return view('goal-tickets.show', compact('goalTicket'));
    }

    public function edit(GoalTicket $goalTicket): View
    {
        return view('goal-tickets.form', [
            'goalTicket' => $goalTicket,
            'heading' => 'แก้ไขข้อมูลแมตช์',
            'submitLabel' => 'บันทึกการแก้ไข',
        ]);
    }

    public function update(Request $request, GoalTicket $goalTicket): RedirectResponse
    {
        $goalTicket->update($this->validatedData($request));

        return redirect()
            ->route('goal-tickets.show', $goalTicket)
            ->with('success', 'แก้ไขข้อมูลแมตช์เรียบร้อยแล้ว');
    }

    public function destroy(GoalTicket $goalTicket): RedirectResponse
    {
        $goalTicket->delete();

        return redirect()
            ->route('goal-tickets.index')
            ->with('success', 'ลบแมตช์เรียบร้อยแล้ว');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'league' => ['required', 'string', 'max:100'],
            'short' => ['required', 'string', 'max:10'],
            'home' => ['required', 'string', 'max:100'],
            'away' => ['required', 'string', 'max:100', 'different:home'],
            'home_short' => ['required', 'string', 'max:10'],
            'away_short' => ['required', 'string', 'max:10'],
            'home_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'away_color' => ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'match_at' => ['required', 'date'],
            'stadium' => ['required', 'string', 'max:150'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'status' => ['required', 'in:AVAILABLE,SOLD OUT,CANCELLED'],
            'featured' => ['sometimes', 'boolean'],
        ]);
    }
}
