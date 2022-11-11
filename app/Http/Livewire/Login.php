<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{
    public $name;

    public $email;

    public $password;

    public $Book_id;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->flash('message', 'You have been successfully login.');
        } else {
            session()->flash('error', 'email and password are wrong.');
        }
    }

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->password = Hash::make($this->password);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'code' => Str::substr(Str::upper($this->name), 0, 2).rand(000000, 999999),
            'slug' => Str::slug($this->name),
            'status' => 'disabled',
        ];

        $user = User::create($data);
        $user->assignRole('User');

        session()->flash('message', 'You have been successfully registered.');

        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function render()
    {
        // dd($this->Book_id);
        return view('livewire.login');
    }
}
