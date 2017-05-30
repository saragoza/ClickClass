<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection as Collection;
use App\Doc;
use App\User;

class DocsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$faker = Faker\Factory::create();
	$type = array ('java', 'junit', 'php', 'javascript', 'html', 'xml');
	$users = User::all();
	$idUsers = array();
	foreach ($users as $user){
		array_push($idUsers, $user->id);
	}
	//crea 150 registros en la tabla docs
        for ($i=0; $i<150; $i++){
		$docs = Doc::all();
		if (isset($docs)) {
			$idDocs = array();
			foreach ($docs as $doc){
				array_push($idDocs, $doc->id);
			}
		}
		$array = $faker->words($nb = 6, $asText = false);
		$collection = Collection::make($array);
		Doc::create([
			'description' =>$faker->text(100),
			'type' =>$faker->randomElement($type),
			'tags'	=>$collection->toJson(),
			'addit_info'=>$faker->optional($weight = 0.9)->text(500),
			'main_doc'=> $faker->optional($weight = 0.1)->randomElement($idDocs),
			'owner'	=>$faker->randomElement($idUsers),
			'file' =>$faker->binData
		]);
	}
    }
}
