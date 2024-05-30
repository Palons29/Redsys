<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $price = $_POST['price'];
    $name = $_POST['name'];

    // Datos del comercio
    $merchant_code = "012809";
    $terminal = "50";
    $currency = "978";
    $transaction_type = "0";
    $secret_key = "UMH2809";

    // Generar código de pedido
    $order = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 12);

    // Concatenar datos para la firma
    $signature_data = $price . $order . $merchant_code . $currency . $transaction_type . $secret_key;

    // Generar la firma
    $signature = strtoupper(sha1($signature_data));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Pago</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Procesar Pago</h1>
        <p><strong>Datos de la compra:</strong></p>
        <p>Importe: <?php echo $price; ?></p>
        <p>Moneda: <?php echo $currency; ?></p>
        <p>Pedido: <?php echo $order; ?></p>
        <p>Descripción del producto: <?php echo $description; ?></p>
        <p>Código del comercio: <?php echo $merchant_code; ?></p>
        <p>Nombre del comercio: Tu Comercio</p>
        <p>Terminal: <?php echo $terminal; ?></p>
        <p>Tipo de operación: <?php echo $transaction_type; ?></p>
        <p>Nombre del cliente: <?php echo $name; ?></p>
        <p>URL OK: http://tu-dominio.com/success.html</p>
        <p>URL KO: http://tu-dominio.com/cancel.html</p>
        <p>Firma digital: <?php echo $signature; ?></p>
    </div>
</body>
</html>
