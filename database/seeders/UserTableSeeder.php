<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::truncate();
        UserDetail::truncate();

        $user_admin=User::create([
            'username'=>'Efsane',
            'email'=>'efsane@mail.ru',
            'password'=>bcrypt('admin'),
            'is_active'=>1,
            'is_admin'=>0
        ]);

        $user_admin->detail()->create([
            'address'=>'Baku',
            'phone'=>'0665567336'
        ]);

        for($i=0; $i<50; $i++){
            $user_customer=User::create([
                'username'=>$faker->name,
                'email'=>$faker->unique()->safeEmail,
                'password'=>bcrypt('admin'),
                'is_active'=>1,
                'is_admin'=>0
            ]);

            $user_customer->detail()->create([
                'address'=>$faker->address,
                'phone'=>$faker->e164PhoneNumber
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
