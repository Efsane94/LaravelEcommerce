<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetail extends Model
{
    use HasFactory;

    protected $table='user_detail';
    public $timestamps=false;

    public $guarded=[];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
