<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $table='order';

    protected $fillable=['cart_id','order_total','card', 'installment_number', 'status'];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }
}
