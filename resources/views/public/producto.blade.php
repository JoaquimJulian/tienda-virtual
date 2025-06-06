@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Producto') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <div class="bg-beig p-16 flex flex-col justify-center sm:items-center gap-4">
        <h1 class="text-marron font-bold text-xl text-center">{{ $producto->nombre }}</h1>
        <div class="sm:flex sm:max-w-fit gap-20 justify-center">
            <div class="sm:flex">
                <div style="max-width: calc(30rem + 3rem);" class="bg-white rounded-xl p-4 h-fit">
                    <div>
                        <img class="rounded-xl w-full" src="{{ Storage::url($producto->imagen_principal) }}" alt="">
                    </div>
                    <div class="mt-4 relative">
                        <div class="flex overflow-x-auto space-x-4 py-2 rounded-lg" 
                            style="max-width: calc(30rem + 3rem); scrollbar-width: thin; scrollbar-color: #8B4513 transparent;">
                            @foreach($fotografias as $fotografia)
                                <div class="flex-shrink-0 w-28">
                                    <img class="rounded-xl object-contain w-full h-auto" src="{{ Storage::url($fotografia->nombre) }}" alt="Fotografía secundaria de {{ $producto->nombre }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="sm:ml-10">
                    <div class="mt-4">
                        <h2 class="text-marron font-bold text-xl mt-2">Descripcion</h2>
                        <p class="text-marron">{{ $producto->descripcion }}</p>
                        <h2 class="text-marron font-bold text-xl mt-2">Precio</h2>
                        <p class="text-naranja font-bold" id="precioUnidad" data-precio="{{ $producto->precio_unidad }}">{{ $producto->precio_unidad }}$</p>
                        
                        <!-- Mostrar el stock disponible -->
                        <h2 class="text-marron font-bold text-xl mt-2">Stock Disponible</h2>
                        <p class="text-marron">{{ $producto->stock }} unidades disponibles</p>

                        <div class="flex mt-2">
                            <h2 class="text-marron font-bold text-xl">Cantidad:</h2>
                            <div class="flex items-center ml-2">
                                <button class="px-2 py-1 bg-gray-200 text-gray-700 rounded-l-md focus:outline-none hover:bg-gray-300" id="btnRestarCantidad">-</button>
                                <input type="text" id="cantidad" name="cantidad" value="1" class="w-10 text-center border-none py-1 bg-gray-200" readonly>
                                <button class="px-2 py-1 bg-gray-200 text-gray-700 rounded-r-md focus:outline-none hover:bg-gray-300" id="btnAumentarCantidad">+</button>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-col justify-between relative">
                            <div>
                                <h2 class="text-marron font-bold text-xl">Total:</h2>
                                <p class="text-naranja font-bold" id="total" data-precio="{{ $producto->precio_unidad }}">{{ $producto->precio_unidad }}$</p>
                            </div>
                            <div class="bottom-0 right-0 mt-8">
                                @if ($producto->codigo == 'BA000-BP')
                                    <button value="{{ $producto }}" class="bg-marron hover:bg-marron-dark text-white font-bold py-2 px-2 rounded-lg">
                                        <a href="{{ route('personalizado.mostrarVista') }}">Personalizar</a>
                                    </button>
                                @else
                                    <div class="flex flex-col justify-center relative">
                                        <button value="{{ $producto }}" class="bg-marron hover:bg-marron-dark text-white font-bold py-2 px-2 rounded-lg" id="btnAnadirProducto">
                                            Añadir al carrito
                                        </button>
                                        <span id="msjAnadido" class="hidden absolute top-full left-0 right-0 text-green-500 text-center mt-1">Producto añadido al carrito</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:w-1/6 flex flex-col items-center mt-4 sm:mt-0">
                <h2 class="text-marron font-bold text-l mt-2 sm:mt-0 mb-2 text-center">Productos relaccionados</h2>
                <div class="sm:h-auto sm:overflow-y-auto sm:scrollbar-thin sm:scrollbar-thumb-marron sm:scrollbar-track-marron pr-2">
                @foreach($productosRelacionados as $productoRelaccionado)
                    <a href="{{ route('producto.show', ['codigo' => $productoRelaccionado->codigo]) }}" class="mt-2 sm:mt-0 flex flex-col items-center bg-white rounded-xl p-4 mb-4">
                        <img src="{{ Storage::url($productoRelaccionado->imagen_principal) }}" alt="Producto relacionado">
                        <p class="text-marron font-semibold mt-2">{{ $productoRelaccionado->nombre }}</p>
                    </a>
                @endforeach
            </div>
            </div>
        </div>
    </div>        
@endsection

<script>
    var userType = "{{ session('user_type') }}"; // Accedes al valor de la sesión en Laravel
    var userId = "{{ session('comprador_id') }}";
</script>

@vite(['resources/js/public/producto.js'])
