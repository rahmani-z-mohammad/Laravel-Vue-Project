<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\List_;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        //by load() method we can find all the model
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );



    }

    public function store(Listing $listing, Request $request)
    {
        //hasFile method Check files uploaded
        if($request->hasFile('images')){

            $request->validate([
                //.* means that the ruls should apply to all elements
                'images.*' => 'mimes:jpg,png,jpeg,webp|max:5000'
            ], [
                'images.*.mimes' => 'The file should be in one of the formats: jpg, png, jpeg, webp'
            ]);
            
            //file method return all the uploaded files
            foreach ($request->file('images') as $file){
                $path = $file->store('images', 'public');

                $listing->images()->save( new ListingImage([
                    'filename' => $path
                ]));
            }

        }
        return redirect()->back()->with('success', 'Images Uploaded!');
    }

    public function destroy($listing, ListingImage $image) {
        
        //delete from the storage
        Storage::disk('public')->delete($image->filename);

        //delete from the database
        $image->delete();

        return redirect()->back()->with('success', 'Image was deleted!');
    }
}
