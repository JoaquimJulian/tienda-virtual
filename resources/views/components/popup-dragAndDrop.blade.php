@if(!session('comprador_id'))
    <x-popup-login />
@endif

<!-- Popup del minijuego -->
<div id="gamePopup" class="fixed hidden inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3">
        <h2 class="text-2xl font-bold mb-4 text-center">Coloca la pieza en su lugar</h2>
        <div class="relative bg-gray-200 h-16 rounded-md flex items-center justify-center w-full">
            <div id="dropZone" class="absolute right-10 bg-green-500 w-16 h-16 rounded-md"></div>
            <div id="puzzlePiece" class="bg-blue-500 w-16 h-16 rounded-md cursor-pointer absolute left-0"></div>
        </div>
        <button id="closeGame" class="mt-4 w-full bg-red-500 text-white py-2 rounded-md">Cerrar</button>
    </div>
</div>

<!-- Popup de mensaje de cupón --> 
<div id="couponPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 text-center">
        <p id="couponMessage" class="mt-2 text-gray-600"></p>
        <button id="closeCouponPopup" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">
            Aceptar
        </button>
    </div>
</div>
<!-- Popup de mensaje de cupón --> 
<div id="couponPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 md:w-1/2 lg:w-1/3 text-center">
        <p id="couponMessage" class="mt-2 text-gray-600"></p>
        <button id="closeCouponPopup" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">
            Aceptar
        </button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const gamePopup = document.getElementById("gamePopup");
    const couponPopup = document.getElementById("couponPopup");
    const puzzlePiece = document.getElementById("puzzlePiece");
    const dropZone = document.getElementById("dropZone");
    const closeGame = document.getElementById("closeGame");
    const closeCouponPopup = document.getElementById("closeCouponPopup");
    const couponMessage = document.getElementById("couponMessage");

    let isDragging = false;
    let offsetX;
    let initialLeft = puzzlePiece.offsetLeft;

    puzzlePiece.addEventListener("mousedown", function (e) {
        isDragging = true;
        offsetX = e.clientX - puzzlePiece.getBoundingClientRect().left;
    });

    document.addEventListener("mousemove", function (e) {
        if (!isDragging) return;
        
        let parentRect = puzzlePiece.parentElement.getBoundingClientRect();
        let newX = e.clientX - parentRect.left - offsetX;
        newX = Math.max(0, Math.min(newX, parentRect.width - puzzlePiece.clientWidth));

        puzzlePiece.style.left = newX + "px";
    });

    document.addEventListener("mouseup", function () {
        if (!isDragging) return;
        isDragging = false;

        let pieceRect = puzzlePiece.getBoundingClientRect();
        let dropRect = dropZone.getBoundingClientRect();

        if (Math.abs(pieceRect.left - dropRect.left) < 10) {
            puzzlePiece.style.left = dropZone.offsetLeft + "px";
            gamePopup.classList.add("hidden");

            let random = Math.random() * 100;

            let tipo_cupon = null;
            if (random < 2) {
                tipo_cupon = "articulo_gratis";
            } else if (random < 11) {
                tipo_cupon = "descuento";
            }

            if (tipo_cupon) {
                fetch("/generar-cupon", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ tipo_cupon })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        couponMessage.innerHTML = `
                            <span class="text-green-600 font-bold text-lg">🎉 ¡Felicidades!</span><br>
                            Has ganado un cupón: <strong>${data.tipo_cupon}</strong><br>
                            <span class="text-gray-800 font-bold">Código: ${data.cupon}</span>
                        `;
                        couponPopup.classList.remove("hidden");
                    } else {
                        console.warn("⚠️ Mensaje del servidor:", data.message);
                        couponMessage.innerHTML = `
                            <span class="text-red-500 font-bold text-lg">⚠️ Oops...</span><br>
                            ${data.message}
                        `;
                        couponPopup.classList.remove("hidden");
                    }
                })
                .catch(error => {
                    console.error("Error en fetch:", error);
                });
            } else {
                couponMessage.innerHTML = `
                    <span class="text-yellow-600 font-bold text-lg">🎭 ¡Casi!</span><br>
                    Esta vez no has ganado un cupón.<br>
                    ¡Inténtalo de nuevo!
                `;
                couponPopup.classList.remove("hidden");
            }
        } else {
            puzzlePiece.style.left = initialLeft + "px";
        }
    });

    closeGame.addEventListener("click", function () {
        gamePopup.classList.add("hidden");
    });

    closeCouponPopup.addEventListener("click", function () {
        couponPopup.classList.add("hidden");
    });
});
</script>
