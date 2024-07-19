<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SellerListingAcceptOfferController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Offer $offer)
    {

        $listing = $offer->listing;
        $this->authorize('update', $listing);

        // Accept
        $offer->update(['accepted_at' => now()]);

        $listing->sold_at = now();
        $listing->save();

        // Reject all other offers
        $listing->offers()->except($offer)
            ->update(['rejected_at' => now()]);

        return redirect()->back()
            ->with('success', "Offer #{$offer->id} has been accepted!");
    }

}
