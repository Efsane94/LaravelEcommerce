<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public  function Index(){

        $categories = Category::WhereRaw('sup_categoryId is null')->take(8)->get();

        //with Eager-Loading isini gorur. Yeni biz ProductDetailleri getirerken hem de butun productlari
        //getirmis oluruq. Yeni database-e az sorgu gedir.
        $slider_products=Product::select('product.*')
            ->join('product_detail','product_detail.product_id','product.id')
            ->where('show_slider',1)
            ->orderby('updated_at')->take(4)->get();

        //Join vasitesiyle 2 table-i elaqelendiririk.
        $opp_day=Product::select('product.*')
            ->join('product_detail','product_detail.product_id','product.id')
            ->where('opportunity_day',1)
            ->orderby('updated_at')->first();

        $stand_out=Product::select('product.*')
            ->join('product_detail','product_detail.product_id','product.id')
            ->where('stand_out',1)
            ->orderby('updated_at')->take(4)->get();

        $selling_lot=Product::select('product.*')
            ->join('product_detail','product_detail.product_id','product.id')
            ->where('selling_lot',1)
            ->orderby('updated_at')->take(4)->get();

        $show_sales=Product::select('product.*')
            ->join('product_detail','product_detail.product_id','product.id')
            ->where('show_sales',1)
            ->orderby('updated_at')->take(4)->get();

        return view('home', compact('categories', 'slider_products','opp_day', 'stand_out', 'selling_lot', 'show_sales'));
    }
}
