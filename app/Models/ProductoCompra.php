<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoCompra extends Model
{
    protected $fillable = ['producto_codigo', 'compra_id', 'cantidad', 'precio_total'];

}
