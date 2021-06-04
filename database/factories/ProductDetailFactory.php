<?php

namespace Database\Factories;

use App\Models\ProductDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
                'product_id'=>Product::factory(),
                'show_slider'=>rand(0,1),
                'opportunity_day'=>rand(0,1),
                'stand_out'=>rand(0,1),
                'selling_lot'=>rand(0,1),
                'show_sales'=>rand(0,1)
        ];
    }
}
