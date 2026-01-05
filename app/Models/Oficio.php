<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BelongsToMany;

class Oficio extends Model
{
    protected $table = 'oficios';

    protected $fillable = [
        'nombre_oficio'
    ];

    public function usuarios(): BelongToMany
    {
        return $this->belongsToMany(
            Usuario::class,
            'dni_nie',
            'id_oficio',
            'nombre_oficio'
        );
    }
}
