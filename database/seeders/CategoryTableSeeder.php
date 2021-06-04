<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table("category")->truncate();
        $id=DB::table("category")->insertGetId(['name'=>"Elektronika", 'slug'=>'elektronika']);
        Db::table("category")->insert(['name'=>'Computer/Tablet', 'slug'=>'computer/tablet', 'sup_categoryId'=>$id]);
        Db::table("category")->insert(['name'=>'Telefon', 'slug'=>'telefon', 'sup_categoryId'=>$id]);
        Db::table("category")->insert(['name'=>'Tv', 'slug'=>'Tv', 'sup_categoryId'=>$id]);

        $id=DB::table("category")->insertGetId(['name'=>"Kitab", 'slug'=>'kitab']);
        DB::table("category")->insert(['name'=>"Edebiyyat", 'slug'=>'edebiyyat','sup_categoryId'=>$id]);
        DB::table("category")->insert(['name'=>"Usaq", 'slug'=>'usaq','sup_categoryId'=>$id]);
        DB::table("category")->insert(['name'=>"Dram", 'slug'=>'dram','sup_categoryId'=>$id]);
        DB::table("category")->insert(['name'=>"Dedektiv", 'slug'=>'dedektiv','sup_categoryId'=>$id]);


        DB::table("category")->insert(['name'=>"Jurnal", 'slug'=>'jurnal']);
        DB::table("category")->insert(['name'=>"Aksesuar", 'slug'=>'aksesuar']);
        DB::table("category")->insert(['name'=>"Mebel", 'slug'=>'mebel']);
        DB::table("category")->insert(['name'=>"Kosmetika", 'slug'=>'kosmetika']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
