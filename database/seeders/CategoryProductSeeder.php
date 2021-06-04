<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::all()->count();
        $product = Product::all()->count();
        for ($i = 0; $i < 50; $i++) {
            DB::table('category_product')->insert([
                'category_id' => rand(1,$category),
                'product_id' => rand(1,$product)
            ]);
        }
    }
}
