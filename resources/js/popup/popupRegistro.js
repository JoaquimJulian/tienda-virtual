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