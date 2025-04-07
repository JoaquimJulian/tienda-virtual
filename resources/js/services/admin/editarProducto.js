let inputPrecio = document.getElementById('precio')

inputPrecio.addEventListener('input', function() {
    // Asegura que solo el valor sea numérico
    let value = inputPrecio.value;

    // Remueve cualquier valor que no sea un número
    inputPrecio.value = value.replace(/[^0-9]/g, '');  // Reemplaza todo lo que no sea un número
});

document.getElementById('codigoEdit').addEventListener('input', function(e) {
    let value = e.target.value;

    // Eliminar caracteres no válidos (solo letras y números)
    value = value.replace(/[^A-Za-z0-9]/g, '');

    // Convertir a mayúsculas
    value = value.toUpperCase();

    // Dividir en partes: 2 letras, 3 números, 2 letras
    let part1 = value.substring(0, 2).replace(/[^A-Z]/g, '');
    let part2 = value.substring(2, 5).replace(/\D/g, '');
    let part3 = value.substring(5, 7).replace(/[^A-Z]/g, '');

    // Ensamblar el valor como AA000-AA
    let formatted = part1 + part2;
    if (part3.length > 0) {
        formatted += '-' + part3;
    }

    // Asignar el valor formateado al input
    e.target.value = formatted;
});

document.getElementById('editarProductoForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.value = 'Guardando...';

    let form = new FormData(this);
    let inputImagenesSecundarias = document.getElementById('fotografias_secundarias');
    let fotos = inputImagenesSecundarias.files;
    let producto_codigo = document.getElementById('codigoEdit').value;

    // Eliminar imágenes secundarias si hay nuevas
    if (fotos.length > 0) {
        try {
            let formData = new FormData();
            formData.append('producto_codigo', producto_codigo);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            await fetch('/producto/eliminiarImagenesSecundarias', {
                method: 'POST',
                body: formData
            });
        } catch (error) {
            console.error(`Error al eliminar imágenes`, error);
        }
    }

    // Subir nuevas imágenes secundarias
    for (let i = 0; i < fotos.length; i++) {
        let formData = new FormData();
        formData.append('fotografia_secundaria', fotos[i]);
        formData.append('producto_codigo', producto_codigo);
        formData.append('_token', document.querySelector('input[name="_token"]').value);

        try {
            await fetch('/producto/subirImagenSecundaria', {
                method: 'POST',
                body: formData
            });
        } catch (error) {
            console.error(`Error al subir la imagen ${i + 1}:`, error);
        }
    }

    // Enviar formulario principal sin imágenes secundarias
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
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: mainFormData
        });

        if (response.ok) {
            window.location.href = window.location.href + '?actualizado=1';
        } else {
            throw new Error('Error al actualizar');
        }
    } catch (error) {
        console.error('Error al actualizar el producto:', error);
        alert('Ocurrió un error al actualizar el producto.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.value = 'Guardar cambios';
    }
});


