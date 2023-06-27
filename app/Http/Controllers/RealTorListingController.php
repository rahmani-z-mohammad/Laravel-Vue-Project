<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealTorListingController extends Controller
{
    public function Index(Request $request)
    {
        //listings() defined before in User Model that User has many listings
        //dd(Auth::user()->listings);
        
        return inertia(
            'Realtor/Index', 
            ['listings' => Auth::user()->listings]
        );
    }
}
