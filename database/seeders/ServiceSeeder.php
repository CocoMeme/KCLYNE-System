<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service; // Import the Service model class

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Use the Service model class and the create method to seed the database
        Service::factory()->count(5)->create();
    }
}
