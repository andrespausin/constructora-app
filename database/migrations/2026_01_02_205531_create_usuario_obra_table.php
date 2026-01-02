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
        Schema::create('usuario_obra', function (Blueprint $table) {
            $table->id();
            $table->string('dni_nie', 15);
            $table->string('id_obra', 20);
            $table->foreign('dni_nie')->references('dni_nie')->on('usuarios');
            $table->foreign('id_obra')->references('id_obra')->on('obras');
            $table->date('fecha_ingreso');
            $table->date('fecha_salida')->nullable();
            $table->decimal('precio_hora', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_obra');
    }
};
