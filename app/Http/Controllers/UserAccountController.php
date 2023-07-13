<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserAccountController extends Controller
{
    public function create(){
        return inertia('UserAccount/Create');
    }

    public function store(Request $request){

    /*
    - When we use confirmed password, laravel know that we have another field by the name of password_confirmation.
    - Auth::login() function user automaticlly login after registration
    */
        
        $user = User::create($request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed'
        ]));
        
        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('listing.index')
        ->with('success', 'Account Created Successfully!');
    }
}
