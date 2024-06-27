<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return inertia('Listing/Index', [
            'listings' => Listing::all()
        ]);
    }

    public function create()
    {
        return inertia('Listing/Create');
    }

    public function store(Request $request)
    {
        Listing::create($request->validate([
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
