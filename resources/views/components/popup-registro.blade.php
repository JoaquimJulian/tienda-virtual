<div id="registroPopup" class="popup fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-sm">
        <!-- Botón para cerrar el modal -->
        <span class="close float-right text-gray-600 cursor-pointer text-2xl pr-2 pt-1" onclick="cerrarPopup('registroPopup')">&times;</span>

        <!-- Título del modal -->
        <h2 class="text-xl font-bold mb-4">Registrarse</h2>

        <!-- Formulario de registro -->
        <form id="formRegistro" method="POST" action="{{ route('comprador.store') }}" class="space-y-4">
            @csrf

            <!-- Campo de nombre -->
            <div>
                <label for="nombre" class="block text-sm text-gray-800 mb-1">Nombre</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    required 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                >
            </div>

            <!-- Campo de apellidos -->
            <div>
                <label for="apellidos" class="block text-sm text-gray-800 mb-1">Apellidos</label>
                <input 
                    type="text" 
                    id="apellidos" 
                    name="apellidos" 
                    required 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                >
            </div>

            <!-- Campo de dirección -->
            <div>
                <label for="direccion" class="block text-sm text-gray-800 mb-1">Dirección</label>
                <input 
                    type="text" 
                    id="direccion" 
                    name="direccion" 
                    required 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                >
            </div>

            <!-- Campo de teléfono -->
            <div>
                <label for="telefono" class="block text-sm text-gray-800 mb-1">Teléfono</label>
                <input 
                    type="tel" 
                    id="telefono" 
                    name="telefono" 
                    pattern="[0-9]{9}" 
                    maxlength="9"
                    required 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                >
            </div>

            <!-- Campo de email -->
            <div>
                <label for="email" class="block text-sm text-gray-800 mb-1">Email</label>
                <input 
                    type="email" 
                    id="emailRegistro" 
                    name="email" 
                    pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$|^[a-zA-Z0-9._%+-]+@googlemail\.com$"
                    title="Debe ser una dirección de Gmail (ejemplo@gmail.com)"
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
                    pattern="^(?=.*[0-9])(?=.*[\W_]).{6,}$"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
                >
            </div>

            <!-- Botón de enviar -->
            <button 
                type="submit"
                class="w-full bg-marron text-white py-2 px-4 rounded hover:bg-gray-800 transition duration-200">
                Registrarse
            </button>

            <!-- Enlace de inicio de sesión -->
            <div class="flex items-center justify-between mt-4">
                <span class="text-sm text-gray-600">¿Ya tienes cuenta? Inicia sesión:</span>
                <button 
                    type="button"
                    onclick="abrirPopup('loginPopup')" 
                    class="bg-marron text-white px-4 py-2 text-sm rounded hover:bg-gray-800 transition duration-200">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</div>

@vite(['resources/js/popup/popupRegistro.js'])