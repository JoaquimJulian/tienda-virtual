<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fotografia extends Model
{
    protected $fillable = ['producto_codigo', 'nombre'];

    public function producto(): BelongsTo {
        return $this->belongsTo(Producto::class);
    }
}
