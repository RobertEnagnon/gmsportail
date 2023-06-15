<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Priorite;
use App\Models\Service;
use App\Models\Societe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre'=>fake()->jobTitle(),
            'message'=>fake()->sentence(10),
            'date'=>Carbon::now(),
            'fichier'=>fake()->word(),
            'client_id'=>Client::inRandomOrder()->first(),
            'service_id'=>Service::inRandomOrder()->first(),
            'priorite_id'=>Priorite::inRandomorder()->first(),
            'societe_id'=>Societe::inRandomOrder()->first(),
            'user_id'=>User::inRandomOrder()->first()
        ];
    }
}
