<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personalizado extends Model
{
    use HasFactory;

    protected $fillable = [
        'comprador_id',
        'producto_codigo',
        'nombre_imagen',
    ];

    // Relación con comprador
    public function comprador()
    {
        return $this->belongsTo(Comprador::class);
    }

    // Relación con producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_codigo', 'codigo');
    }
}
