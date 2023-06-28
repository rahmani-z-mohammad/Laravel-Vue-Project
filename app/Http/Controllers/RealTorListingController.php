<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealTorListingController extends Controller
{
    // action on data need to an authenticate user and we can use the Listing controller constructor also in other controllers
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function Index(Request $request)
    {
        //listings() defined before in User Model that User has many listings
        //dd(Auth::user()->listings);
        
        return inertia(
            'Realtor/Index', 
            ['listings' => Auth::user()->listings]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing -> deleteOrFail();

        return redirect()->back()
                ->with('success','Listing was Deleted!');
    }
}
