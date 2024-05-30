<?php
// Función para generar la firma SHA-1
function generateSignature($order, $amount, $merchantCode, $currency, $transactionType, $terminal, $secretKey) {
    $message = $amount . $order . $merchantCode . $currency . $transactionType . $terminal . $secretKey;
    return strtoupper(sha1($message));
}

// Obtener parámetros del producto
$description = isset($_GET['description']) ? $_GET['description'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$order = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT); // Generar un número de orden único de 12 dígitos
$amount = number_format((float)$price * 100, 0, '', ''); // Convertir precio a céntimos

// Datos del comercio
$merchantCode = '012809'; // Número de Comercio (FUC)
$terminal = '50'; // Número de Terminal
$currency = '978'; // Moneda (Euros)
$transactionType = '0'; // Tipo de Transacción
$secretKey = 'UMH2809'; // Clave secreta

// Generar la firma
$signature = generateSignature($order, $amount, $merchantCode, $currency, $transactionType, $terminal, $secretKey);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="confirmation-page">
    <div class="container">
        <h1>Confirmación de Compra</h1>
        <p class="product-description">Descripción del Producto: <?php echo htmlspecialchars($description); ?></p>
        <p class="product-price">Precio: $<?php echo htmlspecialchars($price); ?></p>
        <form id="redsys-form" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="post">
            <input type="hidden" name="Ds_Merchant_Amount" value="<?php echo $amount; ?>">
            <input type="hidden" name="Ds_Merchant_Order" value="<?php echo $order; ?>">
            <input type="hidden" name="Ds_Merchant_MerchantCode" value="<?php echo $merchantCode; ?>">
            <input type="hidden" name="Ds_Merchant_Currency" value="<?php echo $currency; ?>">
            <input type="hidden" name="Ds_Merchant_TransactionType" value="<?php echo $transactionType; ?>">
            <input type="hidden" name="Ds_Merchant_Terminal" value="<?php echo $terminal; ?>">
            <input type="hidden" name="Ds_Merchant_MerchantURL" value="http://tu-dominio.com/notification">
            <input type="hidden" name="Ds_Merchant_UrlOK" value="http://tu-dominio.com/success.html">
            <input type="hidden" name="Ds_Merchant_UrlKO" value="http://tu-dominio.com/cancel.html">
            <input type="hidden" name="Ds_Merchant_ProductDescription" value="<?php echo htmlspecialchars($description); ?>">
            <input type="hidden" name="Ds_Merchant_MerchantSignature" value="<?php echo $signature; ?>">
            <button type="submit">Pagar con Redsýs</button>
        </form>
    </div>
</body>
</html>
