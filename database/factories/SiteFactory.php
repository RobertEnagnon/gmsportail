<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Societe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle'=>fake()->domainName(),
            'client_id'=>Client::inRandomOrder()->first(),
            'societe_id'=>Societe::inRandomOrder()->first(),
        ];
    }
}
