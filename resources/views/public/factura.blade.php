<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h2>{{ $empresa['nombre'] }}</h2>
    <p>Dirección: {{ $empresa['direccion'] }}</p>
    <p>Teléfono: {{ $empresa['telefono'] }}</p>
    <p>Email: {{ $empresa['email'] }}</p>

    <h3>Detalles de la Factura</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto['nombre'] }}</td>
                <td>{{ $producto['cantidad'] }}</td>
                <td>${{ number_format($producto['precio_total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Resumen</h3>
    <p>Subtotal: ${{ number_format($subtotal, 2) }}</p>
    <p>IVA (21%): ${{ number_format($iva, 2) }}</p>
    <p>Gastos de Envío: ${{ number_format($gastos_envio, 2) }}</p>
    <p class="total">Total a Pagar: ${{ number_format($total, 2) }}</p>
</body>
</html>
