<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Trabajador extends Authenticatable
{
    use Notifiable;

    protected $table = "trabajadores";

    protected $fillable = ['nombre', 'password'];

    // Si usas "nombre" para la autenticación en lugar de email, agrega esto:
    public function getAuthIdentifierName()
    {
        return 'nombre';  // o el nombre del campo que uses para la autenticación
    }

    // Si el campo es "password", asegúrate de que esté protegido
    protected $hidden = ['password'];

    // Opcionalmente, si usas un hash para la contraseña al crear o actualizar el modelo
    public static function boot()
    {
        parent::boot();

        static::creating(function ($trabajador) {
            $trabajador->password = bcrypt($trabajador->password);
        });
    }
}
