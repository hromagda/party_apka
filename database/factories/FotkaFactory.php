<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Fotka;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fotka>
 */
class FotkaFactory extends Factory
{
    protected $model = Fotka::class;

    public function definition(): array
    {
        return [
            'nazev_souboru' => $this->faker->slug . '.jpg',
            'puvodni_nazev' => $this->faker->words(2, true) . '.jpg',

        ];
    }
}

