<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }
        if(auth()->user()->status == 'Pending'){
            $this->addError('status', trans('Your account is Pending. Please contact the administrator of MDRRMO to approve your account. Thanks'));
            return;
        }

        if(auth()->user()->status == 'Blocked'){
            $this->addError('status', trans('Your account is temporarily blocked by the administrator of MDRRMO!'));
            return;
        }

        if(auth()->user()->status == 'Deactivated'){
            $this->addError('status', trans('Your account is deactivated by the administrator of MDRRMO!'));
            return;
        }

        if(auth()->user()->status == 'Activated'){
            switch (auth()->user()->type) {
                case "1001": // user
                    return redirect()->intended(route('user.home'));
                break;
                case "1111": // admin
                    return redirect()->route('admin.home');
                break;
                case "1010": // barangay
                    return redirect()->route('barangay.equipment.index');
                break;
            }
        }
       
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
