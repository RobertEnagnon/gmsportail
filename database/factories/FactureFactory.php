<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Societe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facture>
 */
class FactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle'=>fake()->words(3,true),
            'nom_fichier'=>fake()->text(100),
            'client_id'=>Client::inRandomOrder()->first(),
            'societe_id'=>Societe::inRandomOrder()->first(),
            'date'=>Carbon::now(),
        ];
    }
}
