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
        //dd($request->all());

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request -> only(['by', 'order'])
        ];
        
        return inertia(
            'Realtor/Index', 
            [
                // Pass to view Realtor index
                'filters' => $filters,
                'listings' => Auth::user()->listings()
                ->filter($filters)
                ->withcount('images') // count how many image listing relation has
                ->withcount('offers')
                ->paginate(8)
                ->withQueryString()
                // withQueryString() we dont lose the url filter data when clicking on pages
            ]);
    }

    public function show(Listing $listing){
            return inertia(
                'Realtor/Show',
                ['listing' => $listing->load('offers')]
            );
    }

        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$this->authorize('create', Listing::class);
        return inertia('Realtor/Create');
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

        return redirect() -> route('realtor.listing.index')
        ->with('success', 'Listing was created!');

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Realtor/Edit',
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

    return redirect() -> route('realtor.listing.index')
    ->with('success', 'Listing was Updated!');
    }

    public function restore(Listing $listing){
        $listing->restore();

        return redirect() -> back() ->with('success', 'Listing was restored!');
    }
}
