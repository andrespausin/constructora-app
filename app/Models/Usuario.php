<?php

namespace App\Models;

use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable implements FilamentUser, HasName
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    
    protected $primaryKey = 'dni_nie';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'dni_nie',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'fecha_nacimiento',
        'status',
        'numero_seguridad_social',
        'password',
    ];

    public function getAuthIdentifierName()
    {
    return 'dni_nie';
    }

    /**
     * Indica a Filament qué columna usar para mostrar el nombre del usuario.
     */
    public function getFilamentName(): string
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * Atributos ocultos para la serialización.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de tipos de atributos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', 
        ];
    }

    /**
     * Control de acceso a Filament.
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        // Por ahora permitimos a todos los registros de la tabla 'usuarios'
        return true;
    }
}