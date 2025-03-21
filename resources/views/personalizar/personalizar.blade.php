@extends('layouts.app')

@section('title', 'Personaliza tu bombo')

@section('content')
<div class="w-full m-0">
    <!-- Zona de dibujo -->
    <div class="md:w-1/2 md:float-left">
        <p class="text-2xl text-center mt-4 font-bold text-marron">Dibuja tu propio diseño</p>
        <canvas id="zonaDibujo" width="400" height="400" class="bg-white mx-auto mt-4 rounded-full"></canvas> 
        
        <!-- CAMBIAR GROSOR Y COLOR -->
        <div id="colorgrosor" class="flex justify-center mt-4">
            
        </div>
        <!-- BOTONES -->
        <div class="flex justify-center mt-4">
            <button id="botonSubirDiseño" class="text-white font-bold bg-marron px-4 py-2 m-2 rounded-2xl">Subir diseño</button>
            <button id="botonLimpiar" class="text-white font-bold bg-marron px-4 py-2 m-2 rounded-2xl">Limpiar</button>
            <button id="botonDescargar" class="text-white font-bold bg-marron px-4 py-2 m-2 rounded-2xl">Descargar</button>
            <button id="botonContinuar" class="text-white font-bold bg-marron px-4 py-2 m-2 rounded-2xl">Continuar</button>
        </div>
        <p class="text-marron text-center m-2">Al hacer clic en 'Continuar', autorizas a Tempo & Tono a reutilizar el diseño con fines publicitarios.</p>
    </div>
    <!-- Diseños realizados -->
    <div class="md:w-1/2 md:float-right mt-8 md:mt-0">
        <p class="text-2xl text-center mt-4 font-bold text-marron">Diseños realizados por clientes</p>
        <div id="imagenes" class="grid grid-cols-2 gap-2 mx-auto m-6">
            <!-- Imagenes aleatorias -->
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById("zonaDibujo");
        const ctx = canvas.getContext("2d");
        let dibujando = false;

        // Controles de color y grosor
        const colorgrosor = document.getElementById("colorgrosor");
        colorgrosor.innerHTML = `<input type="color" id="colorPicker" value="#000000">
                                <input type="range" id="grosorPicker" min="1" max="10" value="2">`;

        const colorPicker = document.getElementById("colorPicker");
        const grosorPicker = document.getElementById("grosorPicker");

        ctx.strokeStyle = colorPicker.value;
        ctx.lineWidth = grosorPicker.value;

        // Eventos para cambiar color y grosor
        colorPicker.addEventListener("input", () => ctx.strokeStyle = colorPicker.value);
        grosorPicker.addEventListener("input", () => ctx.lineWidth = grosorPicker.value);

        // Eventos del canvas
        const iniciarDibujo = (e) => {
            dibujando = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        };

        const dibujar = (e) => {
            if (!dibujando) return;
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        };

        const detenerDibujo = () => dibujando = false;

        canvas.addEventListener("mousedown", iniciarDibujo);
        canvas.addEventListener("mousemove", dibujar);
        canvas.addEventListener("mouseup", detenerDibujo);
        canvas.addEventListener("mouseleave", detenerDibujo);

        // Botones de control
        document.getElementById("botonLimpiar").addEventListener("click", () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        document.getElementById("botonDescargar").addEventListener("click", () => {
            const link = document.createElement("a");
            link.href = canvas.toDataURL("image/png");
            link.download = "dibujo.png";
            link.click();
        });

        // Boton continuar
        document.getElementById("botonContinuar").addEventListener("click", () => {
            // Verifica si hay un dibujo en el canvas
            const imageBase64 = canvas.toDataURL("image/png"); // Obtiene la imagen en formato base64 desde el canvas
            if (imageBase64) {
                fetch('/guardar-imagen', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,  // Asegúrate de enviar el token CSRF
                    },
                    body: JSON.stringify({ image: imageBase64 })  // Asegúrate de enviar la imagen en formato base64
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la solicitud');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Imagen guardada correctamente:', data);
                    })
                    .catch(error => {
                        console.error('Error al guardar la imagen:', error);
                    });

            } else {
                alert("No has dibujado nada en el canvas.");
            }
        });

        // Subir imagen y colocarla en el canvas
        document.getElementById("botonSubirDiseño").addEventListener("click", () => {
            const input = document.createElement("input");
            input.type = "file";
            input.accept = "image/*";
            input.addEventListener("change", function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = new Image();
                        img.onload = () => {
                            ctx.clearRect(0, 0, canvas.width, canvas.height);
                            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        };
                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
            input.click();
        });

        // Obtener imágenes aleatorias desde el backend
        fetch('/random-images')
            .then(response => response.json())
            .then(data => {
                const imagenesContainer = document.getElementById('imagenes');
                data.forEach(url => {
                    const img = document.createElement('img');
                    img.src = url;
                    img.alt = "Diseño realizado";
                    img.classList.add("bg-white", "mx-auto", "mt-4", "rounded-full", "w-250", "h-250");
                    img.style.width = "250px";
                    img.style.height = "250px";
                    imagenesContainer.appendChild(img);
                });
            })
            .catch(error => console.error('Error al cargar imágenes:', error));
    });
</script>

@endsection