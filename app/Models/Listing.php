<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'year', 
        'mileage', 
        'name', 'brand', 
        'engine_size', 'color', 'location', 'seller_contact', 'price'];
}
