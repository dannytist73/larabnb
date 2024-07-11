<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    protected $motorcycles = [
        'Honda' => [
            ['name' => 'CBR500R', 'engine_size' => '500cc', 'colors' => ['Grand Prix Red', 'Matt Gunpowder Black Metallic'], 'price_range' => [350000, 400000]],
            ['name' => 'CB650R', 'engine_size' => '650cc', 'colors' => ['Candy Chromosphere Red', 'Matt Gunpowder Black Metallic'], 'price_range' => [450000, 500000]],
        ],
        'Kawasaki' => [
            ['name' => 'Ninja 650', 'engine_size' => '650cc', 'colors' => ['Lime Green', 'Metallic Spark Black'], 'price_range' => [400000, 450000]],
            ['name' => 'Z900', 'engine_size' => '900cc', 'colors' => ['Metallic Spark Black/Metallic Flat Spark Black', 'Candy Lime Green/Metallic Spark Black'], 'price_range' => [550000, 600000]],
        ],
        'Yamaha' => [
            ['name' => 'YZF-R3', 'engine_size' => '321cc', 'colors' => ['Racing Blue', 'Midnight Black'], 'price_range' => [250000, 300000]],
            ['name' => 'MT-09', 'engine_size' => '890cc', 'colors' => ['Icon Blue', 'Tech Black'], 'price_range' => [600000, 650000]],
        ],
        'Harley-Davidson' => [
            ['name' => 'Iron 883', 'engine_size' => '883cc', 'colors' => ['Black Denim', 'Barracuda Silver'], 'price_range' => [700000, 750000]],
            ['name' => 'Street Glide', 'engine_size' => '1745cc', 'colors' => ['Vivid Black', 'Billiard Red'], 'price_range' => [1500000, 1600000]],
        ],
        'BMW' => [
            ['name' => 'S1000RR', 'engine_size' => '999cc', 'colors' => ['Racing Red', 'Light White/Lupin Blue Metallic/Racing Red'], 'price_range' => [1200000, 1300000]],
            ['name' => 'R1250GS', 'engine_size' => '1254cc', 'colors' => ['Black Storm Metallic', 'Ice Grey'], 'price_range' => [1300000, 1400000]],
        ],
        'KTM' => [
            ['name' => '390 Duke', 'engine_size' => '373cc', 'colors' => ['Orange', 'White'], 'price_range' => [300000, 350000]],
            ['name' => '1290 Super Duke R', 'engine_size' => '1301cc', 'colors' => ['Orange', 'Black'], 'price_range' => [1100000, 1200000]],
        ],
    ];

    public function definition(): array
    {
        $brand = $this->faker->randomElement(array_keys($this->motorcycles));
        $model = $this->faker->randomElement($this->motorcycles[$brand]);

        return [
            'year' => $this->faker->numberBetween(2018, date('Y')),
            'mileage' => $this->faker->numberBetween(1000, 50000),
            'name' => $model['name'],
            'brand' => $brand,
            'engine_size' => $model['engine_size'],
            'color' => $this->faker->randomElement($model['colors']),
            'location' => $this->faker->city,
            'seller_contact' => $this->faker->email,
            'price' => $this->faker->numberBetween($model['price_range'][0], $model['price_range'][1]),
        ];
    }
}
