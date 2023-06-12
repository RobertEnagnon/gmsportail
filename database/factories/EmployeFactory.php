<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Site;
use App\Models\Societe;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'matricule'=>fake()->regexify('[A-Z]{3}[0-9]{3,6}'),
            'nom'=>fake()->lastName(),
            'prenom'=>fake()->lastName(),
            'cin'=>fake()->regexify('[0-9]{5}[A-Z]{3}[0-4]{3}'),
            'cnss'=>fake()->regexify('[A-Z]{2}[0-9]{4}[0-4]{2}'),
            'site_id'=>Site::inRandomOrder()->first(),
            'client_id'=>Client::inRandomOrder()->first(),
            'societe_id'=>Societe::inRandomOrder()->first(),
            'date'=>Carbon::now(),
        ];
    }
}
