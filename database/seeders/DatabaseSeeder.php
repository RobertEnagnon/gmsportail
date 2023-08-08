<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'nom' => 'SODJINOU',
            'prenom'=> 'Ronasdev',
            'email' => 'ronasdev@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 1,

        ]);

        // $this->call([
        //         TypeDocumentSeeder::class,
        //         PrioriteSeeder::class,
        //         ServiceSeeder::class,
        //         SocieteSeeder::class,
        //         ClientSeeder::class,
        //         ClientSeeder::class,
        //         DocumentSeeder::class,
        //         SiteSeeder::class,
        //         EmployeSeeder::class,
        //         FactureSeeder::class,
        //         UserSeeder::class,
        //         TicketSeeder::class,
        //     ]);
    }
}
