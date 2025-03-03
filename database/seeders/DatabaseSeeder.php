<?php

namespace Database\Seeders;

use App\Models\Edificio;
use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            DepartamentoTableSeeder::class,
            UsuarioTableSeeder::class,
        ]);

        Usuario::factory(9)->create();
        Edificio::factory(10)->create();

        $this->call([
            DepartamentoEdificioTableSeeder::class,
        ]);

    }
}
