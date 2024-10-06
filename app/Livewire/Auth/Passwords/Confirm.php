<?php

namespace App\Livewire\Auth\Passwords;

use Livewire\Component;

class Confirm extends Component
{
    /** @var string */
    public $password = '';

    public function confirm()
    {
        $this->validate([
            'password' => 'required|current_password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        switch (auth()->user()->type) {
            case "1001": // user
                return redirect()->intended(route('user.home'));
            break;
            case "1111": // admin
                return redirect()->route('admin.home');
            break;
            case "1010": // barangay
                return redirect()->route('barangay.home');
            break;
        }
    }

    public function render()
    {
        return view('livewire.auth.passwords.confirm')->extends('layouts.auth');
    }
}
