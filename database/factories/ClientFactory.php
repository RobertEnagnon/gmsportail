<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>fake()->name(),
            'code'=>fake()->bothify('??????-#####'),
            'logo'=>fake()->text(30),
            'mi_affaire_id'=>1,
            'gms_affaire_id'=>2,
            'mg_affaire_id'=>3,
        ];
    }
}
