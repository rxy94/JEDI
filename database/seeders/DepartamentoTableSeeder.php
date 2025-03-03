<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $departamentos = [
            'Informática',
            'Electrónica',
            'Lengua y Literatura',
            'Salud',
            'Geografía e Historia',
            'Educación Física',
            'Publicidad',
            'Calidad',
        ];

        /* Si quiero meter los datos como un array asociativo dentro del Departamento::create([...]),
            Tengo que usar Departamento::insert([...], [...]) pues create sólo inserta un valor/array y no varios arrays */
        foreach ($departamentos as $item) {
            Departamento::create([
                'nombre' => $item,
            ]);
        }
        
    }
}
