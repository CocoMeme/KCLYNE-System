<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productName = $this->faker->unique()->randomElement([
            'Motul Oil', 
            'Yamalube Gear Oil', 
            'Brake Pad Nissin', 
            'Brake Shoe', 
            'PIAA Horn', 
            'Quantum Battery', 
            'RCB Shock', 
            'Side Mirror', 
            'Quick Tire', 
            'Yamaha Belt Mio'
        ]);

        return [
            'product_name' => $productName,
            'description' => $this->faker->paragraph(),
            'supplier_price' => $this->faker->numberBetween(100, 1200) + 9,
            'seller_retail_price' => $this->faker->numberBetween(110, 1210),
            'category' => $this->faker->randomElement(['Oil', 'Spair Part', 'Tires & Wheels']),
            'product_image' => $productName . '.png' . '|' . $productName . ' 2.png',
        ];
    }

    /**
     * Define the model's state for associating with stock.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withStock()
    {
        return $this->afterCreating(function (Product $product) {
            // Create stock entry for the product
            $stock = new Stock();
            $stock->product_id = $product->id;
            $stock->product_stock = $this->faker->numberBetween(80, 99); // Example stock value
            $stock->save();
        });
    }
}