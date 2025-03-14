let inputPrecio = document.getElementById('precio')

inputPrecio.addEventListener('input', function() {
    // Asegura que solo el valor sea numérico
    let value = inputPrecio.value;

    // Remueve cualquier valor que no sea un número
    inputPrecio.value = value.replace(/[^0-9]/g, '');  // Reemplaza todo lo que no sea un número
});

document.getElementById('editarProductoForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    let form = new FormData(this);
    let inputImagenesSecundarias = document.getElementById('fotografias_secundarias');
    let fotos = inputImagenesSecundarias.files;
    let producto_codigo = document.getElementById('codigo').value;

    if (inputImagenesSecundarias.files.length > 0) {
        try {
            let formData = new FormData();
            formData.append('producto_codigo', producto_codigo); 
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            
            let response = await fetch('/producto/eliminiarImagenesSecundarias', {
                method: 'POST',
                body: formData 
            });

            let result = await response.json();
            console.log('Imagenes eliminadas', result)
        } catch (error){
            console.error(`Error al eliminar las imaganes`, error);
        }
    }
    
    // Subir imágenes secundarias una por una
    for (let i = 0; i < fotos.length; i++) {
        let formData = new FormData();
        formData.append('fotografia_secundaria', fotos[i]);
        formData.append('producto_codigo', producto_codigo)
        formData.append('_token', document.querySelector('input[name="_token"]').value); // CSRF Token
        
        try {
            let response = await fetch('/producto/subirImagenSecundaria', {
                method: 'POST',
                body: formData
            });

            let result = await response.json();
            console.log(`Imagen ${i + 1} subida:`, result);
        } catch (error) {
            console.error(`Error al subir la imagen ${i + 1}:`, error);
        }
    }

    // Luego enviar el formulario principal sin las imágenes secundarias
    let mainFormData = new FormData(this);
    [...mainFormData.keys()].forEach((key) => {
        if (key.startsWith("fotografias_secundarias")) {
            mainFormData.delete(key);
        }
    });

    try {
        let response = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content  // Agrega el CSRF token aquí
            },
            body: mainFormData
        });

        let result = await response.json();
        window.location.href = rutaCrud;
    } catch (error) {
        console.error('Error al actualizar el producto:', error);
    }
});
