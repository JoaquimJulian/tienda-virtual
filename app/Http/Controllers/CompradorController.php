<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comprador;
use Illuminate\Support\Facades\Hash;


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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
