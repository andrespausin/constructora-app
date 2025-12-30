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
        Schema::create('fichajes', function (Blueprint $table) {
            $table->id();
            $table->string('dni_nie', 15);
            $table->string('id_obra', 20);
            $table->foreign('dni_nie')->references('dni_nie')->on('usuarios');
            $table->foreign('id_obra')->references('id_obra')->on('obras');
            $table->dateTime('fecha_hora_entrada');
            $table->dateTime('fecha_hora_salida')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichajes');
    }
};
