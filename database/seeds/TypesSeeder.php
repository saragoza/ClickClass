<?php

use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesArray = array('Archivo comprimido', 'Documento de texto', 'Imagen', 'PDF', 'Java', 'CSS', 'JavaScript', 'HTML', 'WSDL', 'XML', 'PHP', 'Ejecutable');

        for ($i = 0; $i < 12; $i++){

            \DB::table('types')->insert(array(
                'type' => $typesArray[$i]
            ));

        }
    }
}
