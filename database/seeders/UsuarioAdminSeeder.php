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
            "dni_nie" => "00000000A",
            "nombre" => "Andres",
            'apellido' => 'Pausin',
            'email' => 'candrespausin2001@gmail.com',
            'password' => 'admin123'
        ]);
    }
}
