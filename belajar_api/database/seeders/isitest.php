<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class isitest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert ke table siswas
        $faker = Faker::create('id_ID');

        for ($i=1; $i <= 100; $i++) { 
            DB::table('tests')->insert([
                'nama'=>$faker->name
            ]);
        }
    }
}