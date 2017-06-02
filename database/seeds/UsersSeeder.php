<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

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
                'email' => $faker->unique()->email,
                'password' => \Hash::make('secret')
            ));

        }

    }
}
