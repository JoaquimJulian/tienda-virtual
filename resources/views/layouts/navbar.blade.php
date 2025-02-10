<div x-data="{ open: false, abierto: false }" 
    :class="{'h-full' : open, 'h-auto' : !open, 'items-center' : !abierto, 'items-stretch' : abierto}"
    @mouseenter="abierto = true" 
    @mouseleave="abierto = false"
    class="fixed w-full bg-custom-black text-white
    inset-x-0 top-0 sm:w-[100px] sm:flex sm:flex-col sm:align-center
    sm:inset-y-0 sm:left-0 transition-all duration-300 sm:hover:w-[400px]">
    
    <div class="flex justify-end">
        <img @click="open = !open" class="w-15 h-10 mt-3 mb-3 mr-3 mr-3 cursor-pointer" 
            :class="{'sm:mr-3': abierto, 'sm:mr-0': !abierto}"
             src="{{ asset('images/rayas_navegacion.png') }}" 
             alt="navegacion">
    </div>

    <div :class="open ? 'flex flex-col items-center' : 'hidden'"
        class="sm:flex sm:flex-col sm:items-center display-column justify-between h-3/5 mt-20">
        <div class="flex items-center justify-center gap-4 relative group hover:cursor-pointer">
            <p :class="{'block' : open || abierto, 'hidden' : !(open || abierto)}" class="text-xl whitespace-nowrap overflow-hidden">Guitarras electricas</p>
            <img class="w-15 h-10 mt-3 mb-3" src="{{ asset('images/instrumentos/guitarra.png') }}">
            <div class="absolute inset-x-0 bottom-0 border-b-2 border-white scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></div>
        </div>
        <div class="flex items-center justify-center gap-4 relative group hover:cursor-pointer">
            <p :class="{'block' : open || abierto, 'hidden' : !(open || abierto)}" class="text-xl whitespace-nowrap overflow-hidden">Guitarras españolas</p>
            <img class="w-15 h-10 mt-3 mb-3" src="{{ asset('images/instrumentos/guitarra_española.png') }}">
            <div class="absolute inset-x-0 bottom-0 border-b-2 border-white scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></div>
        </div>
        <div class="flex items-center justify-center gap-4 relative group hover:cursor-pointer">
            <p :class="{'block' : open || abierto, 'hidden' : !(open || abierto)}" class="text-xl whitespace-nowrap overflow-hidden">Baterias</p>
            <img class="w-15 h-10 mt-3 mb-3" src="{{ asset('images/instrumentos/bateria.png') }}">
            <div class="absolute inset-x-0 bottom-0 border-b-2 border-white scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></div>
        </div>
        <div class="flex items-center justify-center gap-4 relative group hover:cursor-pointer">
            <p :class="{'block' : open || abierto, 'hidden' : !(open || abierto)}" class="text-xl whitespace-nowrap overflow-hidden">Teclados</p>
            <img class="w-15 h-10 mt-3 mb-3" src="{{ asset('images/instrumentos/teclado.png') }}">
            <div class="absolute inset-x-0 bottom-0 border-b-2 border-white scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></div>
        </div>
        <div class="flex items-center justify-center gap-4 relative group hover:cursor-pointer">
            <p :class="{'block' : open || abierto, 'hidden' : !(open || abierto)}" class="text-xl whitespace-nowrap overflow-hidden">Pianos</p>
            <img class="w-15 h-10 mt-3 mb-3" src="{{ asset('images/instrumentos/piano.png') }}">
            <div class="absolute inset-x-0 bottom-0 border-b-2 border-white scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></div>
        </div>
        <div class="flex items-center justify-center gap-4 relative group hover:cursor-pointer">
            <p :class="{'block' : open || abierto, 'hidden' : !(open || abierto)}" class="text-xl whitespace-nowrap overflow-hidden">Mesas de mezcla</p>
            <img class="w-15 h-10 mt-3 mb-3" src="{{ asset('images/instrumentos/mesa_mezcla.png') }}">
            <div class="absolute inset-x-0 bottom-0 border-b-2 border-white scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></div>
        </div>
        <div class="mt-16" :class="abierto ? 'block' : 'hidden'">
            <div class="relative group hover:cursor-pointer">
                <a class="text-xl mt-3" href="">Ver todo</a>
                <div class="absolute inset-x-0 bottom-0 border-b-2 border-white scale-x-0 group-hover:scale-x-100 transition-transform origin-center"></div>
            </div>
        </div>
    </div>
</div>
