<?php

namespace Database\Seeders;

use App\Models\Societe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocieteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Societe::factory(3)->create();
    }
}
