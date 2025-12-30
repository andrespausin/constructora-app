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
        Schema::create('cuenta_bancaria', function (Blueprint $table) {
            $table->id('id_cuenta');
            $table->string('dni_nie', 15);
            $table->foreign('dni_nie')->references('dni_nie')->on('usuarios');
            $table->string('numero_cuenta', 34)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_bancaria');
    }
};
