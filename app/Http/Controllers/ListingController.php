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
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function create()
    {
        //$this->authorize('create');
        return inertia('Listing/Create');
    }

    public function store(Request $request)
    {
        $request->user()->listings()->create(
            $request->validate([
                "year" => "required|integer|min:1990|max:2024",
                'mileage' => "required|integer|min:1|max:50000",
                'name' => "required",
                'brand' => "required",
                'engine_size' => "required",
                'color' => "required",
                'location' => "required",
                'seller_contact' => "required",
                'price' => "required|integer|min:1|max:20000000",
            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Successfully created a new listing!');
    }

    public function show(Listing $listing)
    {
        // if (Auth::user()->cannot('view', $listing)) {
        //     abort(403);
        // }

        //$this->authorize('view', $listing);
        return inertia('Listing/Show', [
            'listing' => $listing
        ]);
    }

    public function edit(Listing $listing)
    {
        return inertia('Listing/Edit', [
            'listing' => $listing
        ]);
    }

    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                "year" => "required|integer|min:1990|max:2024",
                'mileage' => "required|integer|min:1|max:50000",
                'name' => "required",
                'brand' => "required",
                'engine_size' => "required",
                'color' => "required",
                'location' => "required",
                'seller_contact' => "required",
                'price' => "required|integer|min:1|max:20000000",
            ])
        );
        return redirect()->route('listing.index')
            ->with('success', 'Successfully updated the listing!');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with('success', 'Successfully deleted the listing');
    }
}
