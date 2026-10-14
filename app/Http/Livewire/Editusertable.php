<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Editusertable extends Component
{
    public  $idd,$name,$email,$password;
    public function updateusertable()
    {
       User::where('id', $this->idd)->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
        return redirect()->to('/users');
    }
    public function mount(int $id)
    {
        $user = User::find($id);
        $this->idd = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
    }
    public function render()
    {
        return view('livewire.editusertable');
    }
}