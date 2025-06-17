<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pisnicka;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pisnicka>
 */
class PisnickaFactory extends Factory
{
    protected $model = Pisnicka::class;

    public function definition(): array
    {
        return [
            'interpret' => $this->faker->name(),
            'nazev' => $this->faker->word(),
            'objednavatel' => $this->faker->firstName(),
            'zahrano' => false,
        ];
    }
}
