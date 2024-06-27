<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedSmallInteger('year');

            $table->unsignedInteger('price');
            $table->unsignedInteger('mileage');

            $table->tinyText('name');
            $table->tinyText('brand');
            $table->tinyText('engine_size');
            $table->tinyText('color');
            $table->tinyText('location');
            $table->tinyText('seller_contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('listings', [
            'year', 'mileage', 'name', 'brand', 'engine_size', 'color', 'location', 'seller_contact', 'price', 
        ]);
    }
};
