console.log()
document.getElementById('telefono').addEventListener('input', function (e) {
    this.value = this.value.replace(/\D/g, '').slice(0, 9); // Permite solo números y corta a 9 dígitos
});

document.getElementById('password').addEventListener('input', function (e) {
    const password = e.target.value;
    const regex = /^(?=.*[0-9])(?=.*[\W_]).{6,}$/; // Mínimo un número y un carácter especial
    if (!regex.test(password)) {
        e.target.setCustomValidity("Debe contener al menos un número y un carácter especial, con mínimo 6 caracteres");
    } else {
        e.target.setCustomValidity(""); // Limpia el mensaje de error
    }
});

document.getElementById('formRegistro').addEventListener('submit', async function(e) {
    e.preventDefault(); 

    const telefono = document.getElementById('telefono').value;
    const email = document.getElementById('emailRegistro').value;

    try {
        const response = await fetch("/comprador");
        const compradores = await response.json();
        const telefonoExiste = compradores.some(c => c.telefono === telefono);
        const emailExiste = compradores.some(c => c.email === email);
        
        if (telefonoExiste && emailExiste) {
            abrirPopup('telEmailRegistrado')
        } else if (telefonoExiste) {
            abrirPopup('telRegistrado')
        } else if (emailExiste) {
            abrirPopup('emailRegistrado')
        } else {
            // Si todo está OK, enviar el formulario manualmente
            this.submit();
        }

    } catch (error) {
        console.error("Error consultando compradores:", error);
        alert("Error al verificar los datos. Intenta nuevamente.");
    }
});