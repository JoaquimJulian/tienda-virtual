<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoCompra extends Model
{
    protected $table = 'productos_compras';
    protected $fillable = ['producto_codigo', 'compra_id', 'cantidad', 'precio_total'];

}
