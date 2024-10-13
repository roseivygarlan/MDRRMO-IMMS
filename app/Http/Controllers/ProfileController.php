<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index() {
        return view('pages.profile');
    }

    public function updateProfile(){

    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => ['required', 'min:8'],
            ]);

            $user = User::findOrFail(auth()->user()->id);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json(['success' => true, 'message' => 'Your password has been changed.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

}
