<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerListingController extends Controller
{
    public function index() {
        // dd(Auth::user()->listings());
        return inertia(
            'Seller/Index',
            ['listings' => Auth::user()->listings]
        );
    }
}
