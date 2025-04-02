document.querySelectorAll('.descargarFacturaBtn').forEach(button => {
    button.addEventListener('click', function() {
        // Obtener el data-id del botón específico
        const compraId = this.getAttribute('data-id');

        fetch(`/compra/descargarFactura/${compraId}`, {  
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            // Crear un enlace para descargar el archivo PDF
            const link = document.createElement('a');
            link.href = data.url; 
            link.download = 'factura.pdf'; // Nombre del archivo
            document.body.appendChild(link);
            link.click(); 
            document.body.removeChild(link);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});