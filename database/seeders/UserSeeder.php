<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [

            'Eduarda Peres',
            'eduarda.peres1999@gmail.com',
            Hash::make('Duda195@'),
            NOW(),

        ];

        DB::insert("INSERT INTO users(name, email, password, created_at)VALUES(?, ?, ?, ?)", $data);

    }
}
