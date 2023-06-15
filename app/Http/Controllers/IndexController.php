<?php

namespace App\Http\Controllers;

//use App\Models\Listing;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        // dd(Listing::all());
        //dd(Listing::where('beds', '>=', 4)->orderBy('price', 'asc')->first());

        //Listing::create([
        //    'beds' => 2, 'baths' => 2, 'area' => 100, 'city' => 'North', 'street' => 'Tinker st', 'street_nr' => 20, 'code' => 'TS', 'price' => 200_000
        //]);

        return inertia(
        'Index/Index',
        [
            'message'=>'Hello From Laravel - Index'
        ]   

        );
    }
    public function show(){

        return inertia(
            'Index/Show',
            [
                'message'=>'Hello From Laravel- Show'
            ]   
    
            );
    }
}
