<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
class Addusertable extends Component
{
    public $name,$email,$password;

    public function adduser()
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // Reset the form fields
        $this->name = '';
        $this->email = '';
        $this->password = '';
        return redirect()->to(route('users'));
        
    }

    public function render()
    {
        return view('livewire.addusertable');
    }
}
