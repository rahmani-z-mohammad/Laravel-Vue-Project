<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create(){

        return inertia('Auth/Login');
    }

    public function store(Request $request){

        /*
         Auth::attempt Laravel attempt to find such a user and return true oder false
        second parametr is remember me, for now true means always login untel manualy logout by user
        */
        if(!Auth::attempt($request -> validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true)){
            throw ValidationException::withMessages([
                'email' => 'Authentication Faild!'
            ]);
        }

        $request -> session() -> regenerate();

        /*
        redirect to the login page in create function and this handel automaticlly by laravel
        also we can put our own route like another page in intended function
        */
        return redirect() -> intended('/listing');
 
    }

    public function destroy(Request $request){
        Auth::logout();

        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();
        return redirect()->route('listing.index');
    }
}
