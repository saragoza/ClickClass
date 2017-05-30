<?php

use Illuminate\Database\Seeder;
use App\Perm;
use App\Doc;
use App\User;

class PermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$faker = Faker\Factory::create();
	$writePerm = array ('yes', 'no');
	$grantPerm = array ('write', 'grant', 'all');
	$docs = Doc::all();
	$idDocs = array();
	foreach ($docs as $doc){
		array_push($idDocs, $doc->id);
	}
	$users = User::all();
	$idUsers = array();
	foreach ($users as $user){
		array_push($idUsers, $user->id);
	}
	//crea 2 registros en la tabla permissions
        for ($i=0; $i<2; $i++){
		Perm::create([
			'id_user' =>$faker->unique()->randomElement($idUsers),
			'id_doc' =>$faker->unique()->randomElement($idDocs),
			'write_perm'=>$faker->randomElement($writePerm),
			'grant_perm'=>$faker->randomElement($grantPerm)
		]);
	}
    }
}
