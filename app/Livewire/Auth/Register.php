<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Livewire\Component;

class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $phone = '';

    /** @var string */
    public $address = '';

    /** @var string */
    public $position = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';

    public function register()
    {
        $this->validate([
            'name' => ['required'],
            'phone' => ['required', 'min:10', 'max:10', 'unique:users'],
            'address' => ['required'],
            'position' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'position' => $this->position,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        return redirect()->route('register')->with('success','Your account is created successfully! Please wait for the account approval by the administrator of MDRRMO. Thanks!');
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
