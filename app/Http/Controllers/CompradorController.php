<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprador;
use App\Models\Compra;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class CompradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => ['required', 'regex:/^[0-9]{9}$/', 'unique:compradores,telefono'],
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|googlemail\.com)$/', 'unique:compradores,email'],
            'password' => ['required', 'min:6', 'regex:/^(?=.*[0-9])(?=.*[\W_]).+$/'],
        ]);

        // Crear el comprador
        $comprador = Comprador::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('app');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($comprador_id)
    {
        $comprador = Comprador::find($comprador_id);
        return view('comprador.perfil', compact('comprador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info('entra en update de comprador');
        // Validación de los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:9', 
            'email' => 'required|email|max:255|unique:compradores,email,' . $id, // Asegúrate de no validar el email como único para el comprador actual
            'password' => 'nullable|string|min:6|confirmed', // Si el campo de contraseña es opcional, validamos si está presente
        ]);
       
        // Buscar el comprador por su ID
        $comprador = Comprador::findOrFail($id);

        // Actualizamos los datos del comprador
        $comprador->nombre = $validated['nombre'];
        $comprador->apellidos = $validated['apellidos'];
        $comprador->direccion = $validated['direccion'];
        $comprador->telefono = $validated['telefono'];
        $comprador->email = $validated['email'];

        // Si el usuario proporciona una nueva contraseña, la actualizamos
        if ($request->filled('password')) {
            $comprador->password = bcrypt($validated['password']);
        }

        // Guardar los cambios en la base de datos
        $comprador->save();

        // Redirigir al usuario a una página con un mensaje de éxito
        return redirect()->route('comprador.edit', $comprador->id)
                        ->with('success', 'Datos actualizados correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function mostrarPedidos($comprador_id)
    {
        // Obtener las compras del comprador con los productos relacionados
        $compras = Compra::with(['productos' => function ($query) {
            $query->select('productos.codigo', 'productos.nombre', 'productos.precio_unidad')
                  ->withPivot('cantidad'); // Incluir la cantidad desde la tabla intermedia
        }])
        ->where('comprador_id', $comprador_id)
        ->get(); 

        // Retornar la vista con los datos
        return view('comprador.pedidos', compact('compras'));
    }
}
