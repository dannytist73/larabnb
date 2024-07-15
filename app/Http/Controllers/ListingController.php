<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ListingController extends \Illuminate\Routing\Controller
{

    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Listing::class, 'listing');
    }
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom',
            'priceTo',
            'brand',
            'engine',
            'mileage',
            'location'
        ]);

        return inertia('Listing/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter($filters)
                ->withoutSold()
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }

        //$this->authorize('view', $listing);
        $listing->load(['images']);
        $offer = !Auth::user() ? 
            null : $listing->offers()->byMe()->first();

        return inertia('Listing/Show', [
            'listing' => $listing,
            'offerMade' => $offer
        ]);
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with('success', 'Successfully deleted the listing');
    }
}
