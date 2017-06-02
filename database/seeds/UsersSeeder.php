<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++){

            \DB::table('users')->insert(array(
                'name' => $faker->userName(50),
                'email' => $faker->unique()->email(50),
                'password' => \Hash::make('secret'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ));

        }

    }
}
