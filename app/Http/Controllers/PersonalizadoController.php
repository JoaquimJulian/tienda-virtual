<?php

// app/Http/Controllers/PersonalizadoController.php
namespace App\Http\Controllers;

use App\Models\Personalizado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class PersonalizadoController extends Controller
{
    // app/Http/Controllers/PersonalizadoController.php

    public function guardarImagen(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    
        try {
            $imageData = $request->input('image');
            Log::info('Datos de la imagen recibidos: ', ['imageData' => $imageData]);
    
            $imageName = uniqid('diseño_') . '.png';
            $imagePath = public_path('images');
            $imageFullPath = $imagePath . '/' . $imageName;
    
            $image = str_replace('data:image/png;base64,', '', $imageData);
            $image = base64_decode($image);
    
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }
    
            file_put_contents($imageFullPath, $image);
    
            return response()->json(['message' => 'Imagen guardada correctamente', 'filepath' => $imageFullPath], 200);
        } catch (\Exception $e) {
            Log::error('Error al guardar la imagen: ' . $e->getMessage());
            return response()->json(['error' => 'Error al guardar la imagen: ' . $e->getMessage()], 500);
        }
    }



public function getRandomImages()
    {
        // Ruta de almacenamiento
        $imagePath = storage_path('app/public/images/personalizable');
        
        // Obtener todas las imágenes en la carpeta
        $images = array_diff(scandir($imagePath), array('..', '.'));

        // Seleccionar 4 imágenes aleatorias
        $randomImages = array_rand($images, 4);

        // Devolver las rutas de las imágenes
        $imageUrls = [];
        foreach ($randomImages as $index) {
            $imageUrls[] = asset('storage/images/personalizable/' . $images[$index]);
        }

        return response()->json($imageUrls);
    }

}
