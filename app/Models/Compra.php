<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Compra extends Model
{
    protected $fillable = ['comprador_id', 'precio_total', 'estado', 'fecha_compra', 'fecha_envio'];

    public function comprador(): BelongsTo {
        return $this->belongsTo(Comprador::class, 'comprador_id');
    }
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'productos_compras')->withPivot('cantidad');
    }
}
