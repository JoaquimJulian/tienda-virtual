<!-- resources/views/components/modal-login.blade.php -->
<div id="loginPopup" class="popup fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-sm">
        <!-- Botón para cerrar el modal -->
        <span class="close float-right text-gray-600 cursor-pointer" onclick="cerrarPopup('loginPopup')">&times;</span>

        <!-- Título del modal -->
        <h2 class="text-xl font-bold mb-4">Iniciar sesión</h2>

        <!-- Formulario de login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <!-- Campo de nombre de usuario -->
            <div>
                <label for="nombre" class="block text-sm text-gray-800 mb-1">Nombre de usuario</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    required 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                >
            </div>

            <!-- Campo de contraseña -->
            <div>
                <label for="password" class="block text-sm text-gray-800 mb-1">Contraseña</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                >
            </div>

            <!-- Botón de enviar -->
            <button 
                type="submit"
                class="w-full bg-marron text-white py-2 px-4 rounded hover:bg-gray-800 transition duration-200">
                Iniciar Sesión
            </button>

            <!-- Enlace de registro -->
            <div class="flex items-center justify-between mt-4">
                <span class="text-sm text-gray-600">¿No tienes cuenta? Regístrate:</span>
                <button 
                    type="button"
                    onclick="abrirPopup('registroPopup')" 
                    class="bg-marron text-white px-4 py-2 text-sm rounded hover:bg-gray-800 transition duration-200">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</div>