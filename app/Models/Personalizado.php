<?php

// app/Models/Personalizado.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personalizado extends Model
{
    use HasFactory;

    protected $table = 'personalizados';

    protected $fillable = [
        'comprador_id',
        'producto_codigo',
        'nombre_imagen',
    ];

    public function comprador()
    {
        return $this->belongsTo(Comprador::class, 'comprador_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_codigo', 'codigo');
    }
}
