<div class="w-full px-4 py-4 border-b border-gray-200">
  <div class="max-w-6xl mx-auto flex items-center justify-between">
    <!-- Logo -->
    <a href="{{ route('app') }}" class="text-2xl font-bold text-[#8B2E00]">
      Tempo & Tono
    </a>

    <!-- Navigation -->
    <nav class="flex items-center space-x-8">
      <a href="{{ route('app') }}" class="text-gray-700 hover:text-[#8B2E00]">Comprar</a>
      <a href="#" class="text-gray-700 hover:text-[#8B2E00]">Categorias</a>
      <a href="#" class="text-gray-700 hover:text-[#8B2E00]">Ofertas</a>
      <a href="{{ route('sobrenosotros') }}" class="text-gray-700 hover:text-[#8B2E00]">Sobre nosotros</a>
    </nav>

    <!-- Search Bar -->
    <div class="flex items-center bg-beig rounded-lg px-4 py-1 w-72">
      <input 
        type="text" 
        placeholder="Buscar productos..." 
        class="bg-transparent w-full outline-none border-none focus:outline-none focus:ring-0 text-gray-700 placeholder-gray-400"
        >
      <button class="text-gray-400 hover:text-[#8B2E00]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
      </button>
    </div>

    <!-- User Actions -->
    <div class="flex items-center space-x-4">
      @if(session('user_type') === 'trabajador')
        <a href="{{ route('categoria.create') }}" class="text-gray-700 hover:text-[#8B2E00]">Gestionar productos y categorias</a>
        <a href="#" class="text-gray-700 hover:text-[#8B2E00]">Gestionar pedidos</a>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit">Cerrar sesión</button>
        </form>

      @elseif(session('user_type') === 'comprador')
        <button 
            onclick="abrirPopup('loginPopup')" 
            class="text-gray-700 hover:text-[#8B2E00] focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </button>

        <a href="#" class="relative text-gray-700 hover:text-[#8B2E00]">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
          <span class="absolute -top-2 -right-2 bg-[#FF6B35] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
        </a>
      @else
        <button 
            onclick="abrirPopup('loginPopup')" 
            class="text-gray-700 hover:text-[#8B2E00] focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </button>

        <a href="#" class="relative text-gray-700 hover:text-[#8B2E00]">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
          <span class="absolute -top-2 -right-2 bg-[#FF6B35] text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
        </a>
      @endif
    </div>
  </div>
</div>