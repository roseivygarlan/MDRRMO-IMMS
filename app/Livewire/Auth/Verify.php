<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verify extends Component
{
    public function resend()
    {
        if (Auth::user()->hasVerifiedEmail()) {
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

        Auth::user()->sendEmailVerificationNotification();

        $this->dispatch('resent');

        session()->flash('resent');
    }

    public function render()
    {
        return view('livewire.auth.verify')->extends('layouts.auth');
    }
}
