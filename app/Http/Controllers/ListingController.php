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
    public function index()
    {
        return inertia(
            'Listing/Index',
            [
                'listings'=>Listing::orderByDesc('created_at')
                    ->paginate(10)
            ]   
    
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this->authorize('create', Listing::class);
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        $listing = new Listing();
        $listing -> beds = $request->beds;
        $listing -> save();
        */
        // when we have fillable all column in Model(Listing), then we cann all store by create function through the Listing object Listing::create()

        $request->user()->listings()->create(
                $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|integer|min:1|max:200',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect() -> route('listing.index')
        ->with('success', 'Listing was created!');

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

        return inertia(
            'Listing/Show',
            [
                'listing'=>$listing
            ]   
    
            );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            [
                'listing'=>$listing
            ]   
    
            );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer|min:1|max:200',
            'price' => 'required|integer|min:1|max:20000000',
        ])
    );

    return redirect() -> route('listing.index')
    ->with('success', 'Listing was Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing -> delete();

        return redirect()->back()
                ->with('success','Listing was Deleted!');
    }
}
