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
        Schema::create('obras', function (Blueprint $table) {
            $table->string('id_obra', 20)->primary()->unique();
            $table->string('nombre_obra', 150);
            $table->string('id_cliente');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');

            $table->string('provincia', 100)->nullable();
            $table->string('direccion', 255)->nullable();
            
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->enum('status', ['EN CURSO', 'NO PLANIFICADA', 'FINALIZADA'])->default('NO PLANIFICADA');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
