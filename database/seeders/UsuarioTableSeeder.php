<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Usuario::create([

            'nombre' => 'Ruyi',
            'apellidos' => 'Xia Ye',
            'email' => 'ruyi@jedi.com',
            'password' => Hash::make('password'),
            'perfil' => true,
            'idDep' => 1,

        ]);

    }
}
