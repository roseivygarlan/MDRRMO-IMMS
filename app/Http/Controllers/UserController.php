<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $paginate = true;
        $searchTerm = request('search');
        if($searchTerm){
            $paginate = false;
            $users = User::where('name', 'like', '%'.$searchTerm.'%')
            ->orWhere('phone', 'like', '%'.$searchTerm.'%')
            ->orWhere('address', 'like', '%'.$searchTerm.'%')
            ->orWhere('position', 'like', '%'.$searchTerm.'%')
            ->orWhere('type', 'like', '%'.$searchTerm.'%')
            ->orWhere('email', 'like', '%'.$searchTerm.'%')
            ->orderBy('id', 'desc')->get();
        }else{
            $paginate = true;
            $users = User::paginate(5);
        }
        return view('pages.usermanagement', compact('users','paginate'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users',
            'address' => 'required',
            'position' => 'required',
            'email' => 'required',
        ]);
        User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'position'=>$request->position,
            'email'=>$request->email,
        ]);
        return back()->with('success','Successfully Created!');
    }

    public function update(Request $request)
    {
       
    }

    public function destroy(Request $request)
    {
       
    }
}
