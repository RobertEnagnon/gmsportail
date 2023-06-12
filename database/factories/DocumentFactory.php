<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Societe;
use App\Models\TypeDocument;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle'=>fake()->word(),
            'nom_fichier'=>fake()->word(),
            'type_id'=>TypeDocument::inRandomOrder()->first(),
            'client_id'=>Client::inRandomOrder()->first(),
            'societe_id'=>Societe::inRandomOrder()->first(),
            'date'=>Carbon::now(),
        ];
        // factory(User::class)->create()->id,
    }
}
