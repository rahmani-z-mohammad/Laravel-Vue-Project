<?php

namespace App\Http\Controllers;

//use App\Models\Listing;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){

        // dd(Listing::all());
        //dd(Listing::where('beds', '>=', 4)->orderBy('price', 'asc')->first());

        //Listing::create([
        //    'beds' => 2, 'baths' => 2, 'area' => 100, 'city' => 'North', 'street' => 'Tinker st', 'street_nr' => 20, 'code' => 'TS', 'price' => 200_000
        //]);

        //dd(Auth::user());
        // dd(Auth::check());

        return inertia(
        'Index/Index',
        [
            'message'=>'Hello! This Project was by Laravel, Vue, Inertia and Tailwind CSS'
        ]   

        );
    }
    public function show(){

        return inertia(
            'Index/Show',
            [
                'message'=>'Hello! This Project was by Laravel, Vue, Inertia and Tailwind CSS'
            ]   
    
            );
    }
}
