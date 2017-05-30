<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\User;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$faker = Faker\Factory::create();
	$rol = array ('admin', 'superadmin');
	$users = User::all();
	$idUsers = array();
	foreach ($users as $user){
		array_push($idUsers, $user->id);
	}
	//crea 10 registros en la tabla admins
        for ($i=0; $i<2; $i++){
		Admin::create([
			'id_user' =>$faker->unique()->randomElement($idUsers),
			'rol' =>$faker->randomElement($rol),
			'email'	=>$faker->unique()->email(50)
		]);
	}
    }
}
