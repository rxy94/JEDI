<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class DepartamentoEdificioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [];

        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { 
            array_push($datos, ['idDep' => $faker->numberBetween(1,8), 'idEdi' => $faker->numberBetween(1,10), 'despacho' => $faker->numberBetween(1,10)]);
        }

        DB::table('departamento_edificio')->insert($datos);
    }
}
