<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $paginate = true;
        $searchTerm = request('search');
        $query = User::where('type','<>','1010');

        if($searchTerm){
            $users = $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('position', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $users = $query->orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function allUsers() {
        $paginate = true;
        $searchTerm = request('search');
        if($searchTerm){
            $users = User::where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('position', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $users = User::orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function barangay() {
        $paginate = true;
        $searchTerm = request('search');
        $query = User::where('type', '=', '1010');
        if($searchTerm){
            $users = $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('position', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $users = $query->orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function pendingUserList(){
        $paginate = true;
        $searchTerm = request('search');
        $query = User::where('type','<>','1010')->where('status', 'Pending');

        if($searchTerm){
            $users = $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('position', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $users = $query->orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function activatedUserList(){
        $paginate = true;
        $searchTerm = request('search');
        $query = User::where('status', 'Activated');

        if($searchTerm){
            $users = $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('position', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $users = $query->orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function deactivatedUserList(){
        $paginate = true;
        $searchTerm = request('search');
        $query = User::where('status', 'Deactivated');

        if($searchTerm){
            $users = $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('position', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $users = $query->orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function blockedUserList(){
        $paginate = true;
        $searchTerm = request('search');
        $query = User::where('status', 'Blocked');

        if($searchTerm){
            $users = $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%')
                      ->orWhere('address', 'like', '%' . $searchTerm . '%')
                      ->orWhere('position', 'like', '%' . $searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $searchTerm . '%');
            })->orderBy('id', 'desc')->get();
    
            $paginate = false;
        }else{
            $users = $query->orderBy('id', 'desc')->paginate(5);
            $paginate = true;
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'phone' => ['required', 'unique:users'],
                'address' => ['required'],
                'position' => ['required'],
                'type' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:8'],
            ]);

            User::create([
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'position' => $request->position,
                'type' => $request->type,
                'status' => 'Activated',
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json(['success' => true, 'message' => 'User has been added.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
                'phone' => ['required'],
                'address' => ['required'],
                'position' => ['required'],
                'email' => ['required', 'email'],
            ]);

            $user = User::findOrFail($request->id);
            $user->update([
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'position' => $request->position,
            ]);
    
            return response()->json(['success' => true, 'message' => 'User password has been updated.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => ['required', 'min:8'],
            ]);

            $user = User::findOrFail($request->id);
            $user->update([
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json(['success' => true, 'message' => 'User password has been changed.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['success' => true, 'message' => 'User has been deleted.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    public function changeStatus($id, $status) {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'status' => $status,
            ]);
            return response()->json(['success' => true, 'message' => 'User status has been update.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

}
