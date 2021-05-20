<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public  function Index(){
        $name="Afsana";
        $surname="Qurbanova";
        $names=["Efsane","Emin","Sabir","Ilkin"];
        $users=[
            ["id"=>1, "username" => "Efsane"],
            ["id"=>2, "username" => "Emin"],
            ["id"=>3, "username" => "Sabir"],
            ["id"=>4, "username" => "Ferid"],
            ["id"=>5, "username" => "Ramin"]
        ];
        return view('home',compact('name','surname','names', 'users'));
    }
}
