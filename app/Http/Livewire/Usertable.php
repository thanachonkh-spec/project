<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Usertable extends Component
{
    public function deleteUser(int $id)
    {
       dd($id);
        
    }
    public function render()
    {
        $users = User::query()
            ->get();
           

        return view('livewire.Usertable', compact('users'));
    }
}