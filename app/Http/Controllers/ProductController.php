<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function Index($slug){
        $product=Product::whereSlug($slug)->firstOrFail();
        $categories=$product->categories()->distinct()->get();
        return view("product",compact('product', 'categories'));
    }

    public function Search(){
        $searched= request()->input("word");
        $products=Product::where('name','like',"%$searched%")
            ->orwhere('details','like',"%$searched%")
            ->paginate(4);
            //sehifelendirmek ucun


        //deyiseni session icerisinde saxlayir. Yeni biz Search actionuna geden zaman ordaki placeholder-da daxil edilen
        //soz qalir.
        request()->flash();
        return view('search', compact('products'));
    }
}
