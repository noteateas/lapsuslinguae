<?php

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert(array([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => md5('sifra1!'),
            'birth_date' => '1999-01-31',
            'role_id' => 1
            ],
            [
                'first_name' => 'Teodora',
                'last_name' => 'Nedeljkovic',
                'email' => 'teodora@gmail.com',
                'password' => md5('sifra1!'),
                'birth_date' => '1999-09-14',
                'role_id' => 2
            ]));

        $faker = Faker::create();
        $i = 0;
        while($i<1){
            $id = DB::table('users')->insertGetId([
                'first_name' => $faker->unique()->firstName,
                'last_name' => $faker->unique()->lastName,
                'email' => $faker->unique()->email,
                'password' => md5($faker->password),
                'birth_date' => $faker->date('Y-m-d','now'),
                //role_id' => Role::all()->random()->id
                'role_id' => 2
            ]);

            $i++;
        }

    }
}
