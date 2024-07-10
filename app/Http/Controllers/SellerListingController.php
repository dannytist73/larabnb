<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SellerListingController extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia(
            'Seller/Index',
            [
                'filters' => $filters,
                'listings' => Auth::user()
                    ->listings()
                    ->filter($filters)
                    ->paginate(5)
                    ->withQueryString()
            ]
        );
    }

    public function create()
    {
        //$this->authorize('create');
        return inertia('Seller/Create');
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
        return redirect()->route('seller.listing.index')
            ->with('success', 'Successfully created a new listing!');
    }

    public function edit(Listing $listing)
    {
        return inertia('Seller/Edit', [
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
        return redirect()->route('seller.listing.index')
            ->with('success', 'Successfully updated the listing!');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->back()->with('success', 'Successfully deleted the listing.');
    }

    public function restore(Listing $listing) {
        $listing->restore();

        return redirect()->back()->with('success', 'Successfully restored the listing!');
    }
}
