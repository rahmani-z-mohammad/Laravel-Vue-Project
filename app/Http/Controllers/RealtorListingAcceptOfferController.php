<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorListingAcceptOfferController extends Controller
{
    // single action controller
    public function __invoke(Offer $offer)
    {
        // acccept selected offer
        $offer->update(['accepted_at' => now()]);

        // reject all other offers
        $offer->listing->offers()->except($offer)
        ->update(['rejected_at' => now()]);

        return redirect()->back()
            ->with(
                'success',
                "Offer #{$offer->id} accepted, other offers rejected"
            );
    }
}
