<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cupon extends Model
{
    use HasFactory;

    protected $table = 'cupones';
    
    protected $fillable = ['comprador_id', 'cupon', 'fecha_caducidad', 'tipo_cupon'];

    public static function generarCodigo()
    {
        return strtoupper(bin2hex(random_bytes(4))); // Código aleatorio de 8 caracteres
    }

    public static function crearCupon($comprador_id, $tipo_cupon)
    {
        // Verificar si el usuario ya tiene un cupón activo
        $cuponActivo = self::where('comprador_id', $comprador_id)
                            ->where('fecha_caducidad', '>', Carbon::now())
                            ->exists();

        if ($cuponActivo) {
            return ['success' => false, 'message' => 'Ya tienes un cupón activo.'];
        }

        $cupon = self::create([
            'comprador_id' => $comprador_id,
            'cupon' => self::generarCodigo(),
            'fecha_caducidad' => Carbon::now()->addDay(),
            'tipo_cupon' => $tipo_cupon,
        ]);

        if (!$cupon) {
            return ['success' => false, 'message' => 'Error al crear el cupón.'];
        }

        return ['success' => true, 'cupon' => $cupon->cupon, 'tipo_cupon' => $cupon->tipo_cupon];
    }
}
