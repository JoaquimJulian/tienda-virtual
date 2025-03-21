<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Finder\Finder;  // Usamos Finder en lugar de File
use Illuminate\Support\Facades\Storage;
class ImagenController extends Controller
{
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
