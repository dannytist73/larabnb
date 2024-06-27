<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = $this->faker->numberBetween(2000, date('Y'));

        $motorcycleModels = [
            'Honda CBR500R', 'Kawasaki Ninja 650', 'Yamaha YZF-R3',
            'Harley-Davidson Sportster', 'BMW S1000RR', 'Ducati Monster 821',
            'Suzuki GSX-R750', 'Triumph Street Triple', 'KTM 1290 Super Duke R',
            'Indian Scout', 'Aprilia RSV4', 'Moto Guzzi V7', 'Royal Enfield Interceptor 650'
        ];

        return [
            'year' => $year,
            'mileage' => $this->faker->numberBetween(1000, 50000),
            'name' => $this->faker->randomElement($motorcycleModels),
            'brand' => $this->faker->randomElement(['Honda', 'KTM', 'Kawasaki', 'Yamaha', 'Harley-Davidson', 'BMW']),
            'engine_size' => $this->faker->randomElement(['500cc', '750cc', '1000cc', '1290cc']),
            'color' => $this->faker->safeColorName,
            'location' => $this->faker->city,
            'seller_contact' => $this->faker->email,
            'price' => $this->faker->randomFloat(2, 100000, 5000000),
        ];
    }
}
