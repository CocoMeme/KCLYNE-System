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
        $serviceName = $this->faker->unique()->randomElement([
            'Change Oil',
            'Engine Diagnostic',
            'Electrical System Repair',
            'Air Conditioning Service',
            'Tire Services',
        ]);

        return [
            'service_name' => $serviceName,
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(500, 1000),
            'image' => $serviceName . '.jpg',
        ];
    }
}
