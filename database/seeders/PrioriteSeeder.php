<?php

namespace Database\Seeders;

use App\Models\Priorite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priorite::factory(4)->create();
    }
}
