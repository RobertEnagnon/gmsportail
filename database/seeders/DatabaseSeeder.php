<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
                TypeDocumentSeeder::class,
                PrioriteSeeder::class,
                ServiceSeeder::class,
                SocieteSeeder::class,
                ClientSeeder::class,
                ClientSeeder::class,
                DocumentSeeder::class,
                SiteSeeder::class,
                EmployeSeeder::class,
                FactureSeeder::class,
                UserSeeder::class,
                TicketSeeder::class,
            ]);
    }
}
