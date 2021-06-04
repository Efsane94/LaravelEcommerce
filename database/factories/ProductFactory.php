<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $productName=$this->faker->sentence(2);
            return[
                'name'=>$productName,
                'slug'=> Str::slug($productName),
                'details'=>$this->faker->sentence(5),
                'price'=>$this->faker->randomFloat(3, 1, 20)
            ];
    }
}
