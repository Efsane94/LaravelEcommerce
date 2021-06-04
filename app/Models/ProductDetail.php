<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table="product_detail";

    protected $guarded=[];

    //eger table-da updated_at created_at columnlarini ist etmek istemirikse false edirik.
    public $timestamps=false;

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
