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

    <!-- Navigation -->
    <nav id="nav-general" class="hidden sm:block flex flex-col sm:flex-row items-center gap-8 sm:space-x-8 mt-4 sm:mt-0">
      <a href="{{ route('app') }}" class="text-gray-700 hover:text-[#8B2E00]">Comprar</a>
      <a href="#" class="text-gray-700 hover:text-[#8B2E00]">Categorias</a>
      <a href="#" class="text-gray-700 hover:text-[#8B2E00]">Ofertas</a>
      <a href="{{ route('sobrenosotros') }}" class="text-gray-700 hover:text-[#8B2E00]">Sobre nosotros</a>
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
        <form action="{{ route('logout') }}" method="POST" class="mb-0 mt-8 sm:mt-0">
          @csrf
          <button type="submit" class="text-gray-700 hover:text-[#8B2E00]">Cerrar sesión</button>
        </form>

        <a href="#" class="relative text-gray-700 hover:text-[#8B2E00] mt-8 sm:mt-0 flex justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
        </a>

      @else
        <button 
            onclick="abrirPopup('loginPopup')" 
            class="hidden sm:block text-gray-700 hover:text-[#8B2E00] focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </button>
        
        <button onclick="abrirPopup('loginPopup')" type="submit" class="text-gray-700 hover:text-[#8B2E00] sm:hidden">Iniciar sesión</button>
          
        <a href="#" class="relative text-gray-700 hover:text-[#8B2E00] flex justify-center">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
        </a>
      @endif
    </div>
  </div>
</div>

@vite(['resources/js/components/header.js'])