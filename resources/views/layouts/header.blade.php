<div class="flex border-b-2 border-b-solid border-b-black box-border p-2 pl-5 sm:pr-10 justify-between items-center">
    <div class="flex items-center cursor-pointer">
        <img src="{{ asset('images/icono_correo.png') }}" alt="" class="w-8">
        <p class="ml-1 hidden sm:block">tempo&tono@gmail.com</p>
        <p></p>
    </div>
    <div class="flex items-center gap-5 sm:gap-10">
        <div class="flex items-center sm:gap-2 gap-1 cursor-pointer">
            <img src="{{ asset('images/icono_usuario.png') }}" alt="">
            <a href="{{ route('login.form') }}">Iniciar sesión</a>
        </div>
        <div id="user-trigger" class="flex items-center sm:gap-2 gap-1 cursor-pointer">
            <img src="{{ asset('images/bandera_sp.png') }}" alt="" class="w-6">
            <img src="{{ asset('images/flecha_abajo.png') }}" alt="">
        </div>
        <div id="dropdownHeader" class="hidden absolute top-full left-0 mt-2 bg-white shadow-lg rounded-lg w-48 p-2">
            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Inglés</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Alemán</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-200">Francés</a>
        </div>
    </div>
</div>