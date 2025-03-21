let btnGuardarTarjeta = document.getElementById('btnGuardarTarjeta')

btnGuardarTarjeta.addEventListener('click', function() {
    let numero = document.getElementById('numero').value
    let nombre = document.getElementById('nombreTarjeta').value
    let fechaExpiracion = document.getElementById('fechaExpiracion').value
    let cvv = document.getElementById('cvv').value

    let datos = {
        numero: numero,
        nombre: nombre,
        fechaExpiracion: fechaExpiracion,
        cvv: cvv
    }

    fetch('/compra/guardarTarjeta', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(datos)  // Convierte el objeto JavaScript en JSON
    })
    .then(response => response.json())  // Asegúrate de manejar la respuesta correctamente
    .then(data => {
        if(data.success) {
            cerrarPopup('anadirTarjetaPopup')
            window.location.reload()
        }
    })
    .catch(error => {
        console.error("Hubo un error al guardar la tarjeta: ", error);
    });
})