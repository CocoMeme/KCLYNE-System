<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_name' => $this->faker->randomElement([
                'Change Oil',
                'Engine Diagnostic',
                'Electrical System Repair',
                'Air Conditioning Service',
                'Tire Services',
            ]),
            'description' => $this->faker->paragraph(rand(3, 4)),
            'price' => rand(500, 1000),
            'image' => 'service_name.jpg',
        ];
    }
}
