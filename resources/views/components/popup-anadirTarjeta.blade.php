<!-- resources/views/components/modal-login.blade.php -->
<div id="anadirTarjetaPopup" class="popup fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-sm shadow-md">
        <div class="mb-4">
            <h2 class="text-xl font-medium text-gray-800">Añadir nueva tarjeta</h2>
            <p class="text-sm text-gray-600 mt-1">Ingrese los datos de su tarjeta</p>
        </div>

        <div>
            <!-- Número de tarjeta -->
            <div class="mb-4">
                <label for="numero" class="block text-sm font-medium text-gray-700 mb-1">
                    Número de tarjeta
                </label>
                <input type="text" 
                       id="numero" 
                       name="numero" 
                       placeholder="XXXX XXXX XXXX XXXX" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                       autocomplete="cc-number"
                       maxlength="16"
                       pattern="\d{16}"
                       oninput="this.value = this.value.replace(/\D/g, '')">
            </div>

            <!-- Nombre del titular -->
            <div class="mb-4">
                <label  class="block text-sm font-medium text-gray-700 mb-1">
                    Nombre del titular
                </label>
                <input type="text" 
                       id="nombreTarjeta"
                       name="nombre" 
                       placeholder="Como aparece en la tarjeta" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                       autocomplete="cc-name">
            </div>

            <!-- Fecha y CVV en fila -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <!-- Fecha de expiración -->
                <div>
                    <label for="fechaExpiracion" class="block text-sm font-medium text-gray-700 mb-1">
                        Fecha de expiración
                    </label>
                    <input type="text" 
                           id="fechaExpiracion" 
                           name="fechaExpiracion" 
                           placeholder="MM/AA"
                           maxlength="5"
                           pattern="^\d{2}\/\d{2}$"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                           autocomplete="cc-exp">
                </div>

                <!-- CVV -->
                <div>
                    <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">
                        CVV
                    </label>
                    <input type="text" 
                           id="cvv" 
                           name="cvv" 
                           placeholder="XXX"
                           maxlength="3"
                           pattern="\d{3}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                           autocomplete="cc-csc">
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-between space-x-3">
                <button type="button" 
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        onclick="document.getElementById('anadirTarjetaPopup').classList.add('hidden')">
                    Cancelar
                </button>
                <button id="btnGuardarTarjeta" 
                        class="px-4 py-2 text-sm font-medium text-white bg-marron rounded-md hover:bg-brown-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brown-500">
                    Añadir tarjeta
                </button>
            </div>
        </div>
    </div>
</div>

@vite(['resources/js/popup/anadirTarjeta.js'])