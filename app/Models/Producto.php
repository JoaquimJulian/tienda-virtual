<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{

    protected $primaryKey = 'codigo'; 
    
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['codigo', 'nombre', 'descripcion', 'categoria_id', 'precio_unidad', 'stock', 'destacado', 'imagen_principal'];

    public function fotografias(): HasMany{
        return $this->hasMany(Fotografia::class);
    }
    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class);
    }
    public function compras(): BelongsToMany
    {
        return $this->belongsToMany(Compra::class, 'productos_compras')->withPivot('cantidad');
    }
}
