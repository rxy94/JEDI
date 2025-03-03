<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departamento_edificio', function (Blueprint $table) {

            # PK
            $table->id('idDE');

            $table->integer('despacho');

            # FK
            $table->foreignId('idDep')
                  ->constrained('departamento', 'idDep')
                  ->onUpdate('cascade');
            
            $table->foreignId('idEdi')
                  ->constrained('edificio', 'idEdi')
                  ->onUpdate('cascade');

            # Restrincción
            $table->unique(['idDep', 'idEdi']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamento_edificio');
    }
};
