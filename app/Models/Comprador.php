<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Comprador extends Model
{
    protected $table = "compradores";

    protected $fillable = ['nombre', 'apellidos', 'direccion', 'telefono', 'email', 'password'];

    public function compras(): HasMany{
        return $this->hasMany(Compra::class);
    }
}
