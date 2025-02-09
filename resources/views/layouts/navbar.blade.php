<div x-data="{ open: false }" 
    :class="open ? 'h-full' : 'h-auto'"
    class="fixed w-full bg-custom-black text-white 
    inset-x-0 top-0 sm:w-[100px] sm:flex sm:flex-col sm:align-center
    sm:inset-y-0 sm:left-0 transition-all duration-300 sm:hover:w-[400px]">
    
    <!-- Botón de Toggle SOLO para móviles -->
    <div class="flex justify-end">
        <img @click="open = !open" class="w-20 h-15 mt-3 mb-3 mr-3 cursor-pointer" 
             src="{{ asset('images/rayas_navegacion.png') }}" 
             alt="navegacion">
    </div>

    <!-- Menú desplegable -->
    <div :class="open ? 'flex flex-col' : 'hidden'"
         class="sm:flex sm:flex-col display-column justify-between h-3/5 mt-20">
        <div><img class="w-15 h-10 mt-3 mx-auto mb-3" src="{{ asset('images/instrumentos/guitarra.png') }}"></div>
        <div><img class="w-15 h-10 mt-3 mx-auto mb-3" src="{{ asset('images/instrumentos/guitarra_española.png') }}"></div>
        <div><img class="w-15 h-10 mt-3 mx-auto mb-3" src="{{ asset('images/instrumentos/bateria.png') }}"></div>
        <div><img class="w-15 h-10 mt-3 mx-auto mb-3" src="{{ asset('images/instrumentos/teclado.png') }}"></div>
        <div><img class="w-15 h-10 mt-3 mx-auto mb-3" src="{{ asset('images/instrumentos/piano.png') }}"></div>
        <div><img class="w-15 h-10 mt-3 mx-auto mb-3" src="{{ asset('images/instrumentos/mesa_mezcla.png') }}"></div>
    </div>

</div>
