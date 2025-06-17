<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vzkaz;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vzkaz>
 */
class VzkazFactory extends Factory
{
    protected $model = Vzkaz::class;

    public function definition(): array
    {
        return [
            'jmeno' => $this->faker->name(),
            'text' => $this->faker->word(),

        ];
    }
}
