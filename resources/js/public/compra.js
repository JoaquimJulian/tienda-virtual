// acción de pagar
document.addEventListener("DOMContentLoaded", function () {
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    var submitButton = form.querySelector('button[type="submit"]');  // Seleccionamos el botón de pago

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        submitButton.disabled = true;
        submitButton.textContent = 'Procesando pago...';

        // Crear el token con los detalles de la tarjeta
        const {token, error} = await stripe.createToken(card);

        if (error) {
            // Mostrar el error si ocurre
            alert(error.message);
        } else {
            // Crear un campo oculto para el token
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Crear los datos del formulario, incluyendo el token
            var formData = new FormData(form);
            
            // Enviar la solicitud al backend
            fetch(rutaFuncionPagar, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const link = document.createElement('a');
                    link.href = data.url; // Obtener la URL de la factura
                    link.download = 'factura.pdf'; // Nombre sugerido para el archivo PDF
                    document.body.appendChild(link);
                    link.click(); // Iniciar la descarga
                    document.body.removeChild(link);

                    window.location.href = rutaApp; // Redirigir después del pago exitoso
                } else {
                    console.log('Hubo un problema con el pago');
                }
                // Restaurar el botón después del proceso
                submitButton.disabled = false;
                submitButton.textContent = 'Pagar';
            })
            .catch(error => {
                console.error('Error en el pago:', error);
                alert('Hubo un error al procesar el pago');

                // Restaurar el botón después de un error
                submitButton.disabled = false;
                submitButton.textContent = 'Pagar';
            });
        }
    });
});