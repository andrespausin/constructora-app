<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Usuario::create([
            "dni_nie" => "Z3781646Z",
            "nombre" => "Andres",
            'apellido' => 'Pausin',
            'email' => 'candrespausin2001@gmail.com',
            'telefono' => '600123456',
            'fecha_nacimiento' => '2001-08-20',
            'status' => 'baja',
            'numero_seguridad_social' => '4137656889',
            'password' => 'admin123'
        ]);

        \App\Models\Rol::create([
            'nombre' => 'Administrador',
            'descripcion' => 'Usuario con todos los privilegios del sistema.'
        ]);
    }
}
