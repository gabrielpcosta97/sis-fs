<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AndarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $strInsert = "INSERT INTO Andar(nome)VALUES(?)";

        $nomes = [
            'Térreo',
            'Piso Superior',
            'Piso Inferior',
        ];

        foreach($nomes as $nome)
        {

            DB::insert($strInsert, [$nome]);
        }

    }
}
