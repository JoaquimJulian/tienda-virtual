<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['codigo', 'nombre', 'descripcion', 'categoria_id', 'precio_unidad', 'stock', 'destacado'];

    public function fotografias(): HasMany{
        return $this->hasMany(Fotografia::class);
    }
    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class);
    }
    public function compras(): BelongsToMany
    {
        return $this-belongsToMany(Compra::class, 'productos_compras');
    }
}
