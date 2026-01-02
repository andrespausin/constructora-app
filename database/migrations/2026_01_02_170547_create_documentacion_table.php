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
        Schema::create('documentacion', function (Blueprint $table) {
            $table->id();
            $table->string('dni_nie', 15);
            $table->foreign('dni_nie')->references('dni_nie')->on('usuarios');
            $table->enum('tipo_documento', [
                'DNI_NIE',
                'CARNET_CONDUCIR',
                'RECONOCIMIENTO_MEDICO',
                'OTRO'
            ]);
            $table->date('fecha_vencimiento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentacion');
    }
};
