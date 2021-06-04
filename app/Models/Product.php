<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table="product";

    //Butun sutun deyerlerinin database-e elave oluna bileceyini gosterir. Bunu yazdiqdan sonra
    //$fillable qeyd etmeye ehtiyac yoxdu.

    protected $guarded=[];

    public function categories(){
        return $this->belongsToMany('App\Models\Category','category_product');
    }

    public function detail(){
        return $this->hasOne('App\Models\ProductDetail')->withDefault();
    }
}
