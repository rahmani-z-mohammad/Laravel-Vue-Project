<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Auth::login(
            User::create($request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed'
            ]))
        );

        return redirect()->route('listing.index')
        ->with('success', 'Account Created Successfully!');
    }
}
