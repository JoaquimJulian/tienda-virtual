<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = ['compradores_id', 'precio_total', 'estado', 'fecha_compra', 'fecha_envio'];

    public function comprador(): BelongsTo {
        return $this->belongsTo(Comprador::class);
    }
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'productos_compras');
    }
}
