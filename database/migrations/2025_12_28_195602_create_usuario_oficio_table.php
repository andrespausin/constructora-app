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
        Schema::create('usuario_oficio', function (Blueprint $table) {
            $table->id();
            $table->string('dni_nie', 15)->references('dni_nie')->on('usuarios');
            $table->unsignedBigInteger('id_oficio');
            $table->foreign('id_oficio')->references('id_oficio')->on('oficios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_oficio');
    }
};
