<div id="header" class="w-screen sm:h-auto px-4 py-4 border-b border-gray-200 relative">
  <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between">
    <!-- Logo -->
    <a href="{{ route('app') }}" class="text-2xl font-bold text-[#8B2E00]">
      Tempo & Tono
    </a>

    <!-- Botón de menú (visible en móviles) -->
    <button id="menu-toggle" class="block md:hidden text-gray-700 hover:text-[#8B2E00] focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>

    <nav id="nav-general" class="hidden sm:block">
      <ul class="flex flex-col sm:flex-row items-center gap-4 sm:space-x-6">
        <li>
          <a href="{{ route('app') }}" class="text-gray-700 hover:text-[#8B2E00]">Comprar</a>
        </li>
        <li class="relative group hidden sm:block">
          <a href="#" class="text-gray-700 hover:text-[#8B2E00] flex items-center">
            Categorías
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </a>
          <!-- Submenú -->
          <ul class="absolute left-0 top-full mt-0 w-48 bg-white shadow-lg border border-gray-200 rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-opacity duration-200">
            @foreach ($categorias as $category)
              <li>
                <a href="{{ route('categorias.productoscategoria', ['id' => $category->id]) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $category->nombre }}</a>
              </li>
            @endforeach
          </ul>
        </li>
        <!-- Botón de categorias en movil oculto -->
        <button id="categorias-movil-oculto" class="block md:hidden text-gray-700 hover:text-[#8B2E00] focus:outline-none">
            Categorías
            <svg class="w-4 h-4 ml-1 mt-1 float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- Botón de categorias en movil visible -->
        <button id="categorias-movil-visible" class="hidden md:hidden text-gray-700 hover:text-[#8B2E00] focus:outline-none">
            Categorías
            <svg class="w-4 h-4 ml-1 mt-1 float-right" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 15l-7-7-7 7"/>
            </svg>
        </button>

        <ul id="categorias-movil-opciones" class="hidden md:hidden text-center">
            @foreach ($categorias as $category)
              <li>
                <a href="{{ route('categorias.productoscategoria', ['id' => $category->id]) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $category->nombre }}</a>
              </li>
            @endforeach
        </ul>

        <li>
          <a href="#" class="text-gray-700 hover:text-[#8B2E00]">Ofertas</a>
        </li>
        <li>
          <a href="{{ route('sobrenosotros') }}" class="text-gray-700 hover:text-[#8B2E00]">Sobre nosotros</a>
        </li>
      </ul>
    </nav>


    @if(session('user_type') !== 'trabajador')
      <!-- Search Bar -->
      <div class="relative">
        <div class="hidden md:flex items-center bg-beig rounded-lg px-4 py-1 w-72 relative">
          <input 
            id="inputBusqueda"
            type="text"
            autocomplete="off"
            placeholder="Buscar productos..." 
            class="bg-transparent w-full outline-none border-none focus:outline-none focus:ring-0 text-gray-700 placeholder-gray-400"
            >
          <button class="text-gray-400 hover:text-[#8B2E00]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </button>
        </div>
        <div class="hidden hover:bg-marron hover:text-white"></div>
        <div id="resultadosBusquedaContainer">

        </div>
      </div>
    @endif

    <!-- User Actions -->
    <div id="user-actions" class="hidden md:flex flex-col justify-center items-center sm:flex-row items-center sm:space-x-4 space-y-8 sm:space-y-0 text-center mt-8 sm:mt-0">

      @if(session('user_type') === 'trabajador')
        <a href="{{ route('categoria.create') }}" class="w-full sm:w-auto block text-gray-700 hover:text-[#8B2E00]">Gestionar productos y categorias</a>
        <a href="{{ route('compra.create') }}" class="w-full sm:w-auto block text-gray-700 hover:text-[#8B2E00]">Gestionar pedidos</a>
        <form action="{{ route('logout') }}" method="POST" class="mb-0 sm:mt-0 flex justify-center">
          @csrf
          <button type="submit" class="text-gray-700 hover:text-[#8B2E00]">Cerrar sesión</button>
        </form>

      @elseif(session('user_type') === 'comprador')
      <div class="relative">
        <!-- Botón que activa el dropdown -->
        <button id="dropdownBtn" class="hidden sm:block text-gray-700 hover:text-[#8B2E00] focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
        </button>

        <!-- Dropdown -->
        <div id="dropdownMenu" class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg z-10 hidden">
          
          <form action="{{ route('comprador.edit', ['comprador' => session('comprador_id')]) }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
              Perfil
            </button>
          </form>

          <form action="{{ route('comprador.mostrarPedidos', ['comprador_id' => session('comprador_id')]) }}" method="GET">
            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
              Pedidos
            </button>
          </form>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
              Cerrar sesión
            </button>
          </form>
        </div>
      </div>

      <a href="{{ route('carrito.create') }}" class="relative text-gray-700 hover:text-[#8B2E00] mt-8 sm:mt-0 flex justify-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
        </svg>
      </a>

      @else
        <button onclick="abrirPopup('loginPopup')" type="submit" class="text-gray-700 hover:text-[#8B2E00]">Iniciar sesión / Registrarse</button>
          
        <a href="{{ route('carrito.create') }}" class="relative text-gray-700 hover:text-[#8B2E00] flex justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
        </a>
      @endif
    </div>
  </div>
</div>

@vite(['resources/js/components/header.js'])