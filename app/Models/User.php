<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $table='user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'activation_key',
        'is_active',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'activation_key'
    ];

    public function detail(){
        return $this->hasOne('App\Models\UserDetail');
    }
}
