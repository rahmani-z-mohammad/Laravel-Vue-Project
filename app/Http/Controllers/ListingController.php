<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    /*
    The ways how apply the users are authorize to perform action or not through the Model Policy

    Thirth Way and the simplist way

    'listing' name of the parameter
    */

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        /*
        - The when method allows youe to conditionally build queries.
        - ?? false by this way when some filter fields are emty then we dont have error by clicking pagination

        scopeMostRecent() is Local query scope function that we define in Model to be reusable any evrywhere,
        but in controller we use just mostRecent() without scope writing at first of function.
        */

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings'=> Listing::mostRecent()
                ->filter($filters)
                ->withoutSold()
                ->paginate(10)
                ->withQueryString()
                // withQueryString() we dont lose the url filter data when clicking on pages
            ]   
    
            );
    }


    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // The ways to apply users are authorize to perform action or not through the Model Policy

        /*
        - First Way
        if(Auth::user()->cannot('view', $listing)){
            abort(403);
        }
        */

        /*
        do the above action. check if the current user is authorize to perform this view operaion on $listing model
        if not automaticlly return 403 error

        -Second Way
        $this->authorize('view', $listing);
        */

        $listing->load('images');
        $offer = !Auth::user() ?
            null : $listing->offers()->byMe()->first();

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }

    

    
}
