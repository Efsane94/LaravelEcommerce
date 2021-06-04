<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($slug)
    {
        $category=Category::where('slug',$slug)->FirstOrFail();
        $subCategories=Category::where('sup_categoryId',$category->id)->get();

        $order=request('order');

        if($order=='sellinglot'){
            $products=$category->products()
                ->join('product_detail','product_detail.product_id','product.id')
                ->orderbydesc('product_detail.selling_lot')
                ->paginate(2);
        }
        elseif($order=='newproducts'){
            $products=$category->products()
                ->join('product_detail','product_detail.product_id','product.id')
                ->orderbydesc('product_detail.id')
                ->paginate(2);
        }
        else{
            $products=$category->products()->paginate(2);
        }
        return view("category",compact('category','subCategories','products'));
    }
}
