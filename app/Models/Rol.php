<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illiminate\Database\Eloquent\Relations\BelongsToMany;

class Rol extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nombre', //Required
        'descripcion',
    ];

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(
            Usuario::class, 
            'usuario_rol',
            'rol_id',
            'dni_nie'
        );
    }

    
}
