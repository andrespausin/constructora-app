<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            // INFORMACION PERSONAL
            $table->string('dni_nie', 15)->primary();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('telefono', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();

            // INFORMACION LABORAL
            $table->enum('tipo_usuario', ['ADMIN', 'JEFE', 'TRABAJADOR']);
            $table->enum('status', ['ALTA', 'BAJA'])->default('ALTA');
            $table->date('fecha_alta')->default(Carbon::now());
            $table->date('fecha_baja')->nullable();

            // INFORMACION ADICIONAL
            $table->boolean('carnet_conducir')->default(false);
            $table->string('numero_seguridad_social', 20)->unique()->nullable();
            $table->string('descripcion', 500)->nullable();

            $table->string('created_by', 100)->nullable();
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
