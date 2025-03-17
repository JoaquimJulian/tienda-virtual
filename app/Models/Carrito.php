<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['comprador_id', 'producto_codigo', 'cantidad'];

    public function comprador()
    {
        return $this->belongsTo(Comprador::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
