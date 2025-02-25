<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Foundation\Auth\User as Authenticatable;


class Comprador extends Authenticatable
{
    protected $table = "compradores";

    protected $fillable = ['nombre', 'apellidos', 'direccion', 'telefono', 'email', 'password'];

    public function compras(): HasMany{
        return $this->hasMany(Compra::class);
    }

    public function getAuthIdentifierName()
    {
        return 'nombre';  // o el nombre del campo que uses para la autenticación
    }
}
