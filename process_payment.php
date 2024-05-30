<?php
function generateOrderCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $orderCode = '';
    for ($i = 0; $i < 12; $i++) {
        $orderCode .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $orderCode;
}

function generateSignature($amount, $order, $merchantCode, $currency, $transactionType, $secretKey) {
    $data = $amount . $order . $merchantCode . $currency . $transactionType . $secretKey;
    $signature = sha1($data);
    return strtoupper($signature);
}

$amount = $_POST['price'];
$order = generateOrderCode();
$merchantCode = "012809";
$currency = "978";
$transactionType = "0";
$secretKey = "UMH2809";
$signature = generateSignature($amount, $order, $merchantCode, $currency, $transactionType, $secretKey);
$productDescription = $_POST['description'];
$merchantName = "Mi Comercio";
$customerName = $_POST['customer-name'];
$urlOK = "http://tu-dominio.com/success.html";
$urlKO = "http://tu-dominio.com/cancel.html";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulación de Pago con Redsýs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Datos de la Compra</h1>
        <p><strong>Ds_Merchant_Amount:</strong> <?php echo $amount; ?></p>
        <p><strong>Ds_Merchant_Currency:</strong> <?php echo $currency; ?></p>
        <p><strong>Ds_Merchant_Order:</strong> <?php echo $order; ?></p>
        <p><strong>Ds_Merchant_ProductDescription:</strong> <?php echo $productDescription; ?></p>
        <p><strong>DS_Merchant_MerchantCode:</strong> <?php echo $merchantCode; ?></p>
        <p><strong>DS_Merchant_MerchantName:</strong> <?php echo $merchantName; ?></p>
        <p><strong>DS_Merchant_Terminal:</strong> 50</p>
        <p><strong>DS_Merchant_TransactionType:</strong> <?php echo $transactionType; ?></p>
        <p><strong>DS_Merchant_Titular:</strong> <?php echo $customerName; ?></p>
        <p><strong>DS_Merchant_urlOK:</strong> <?php echo $urlOK; ?></p>
        <p><strong>DS_Merchant_urlKO:</strong> <?php echo $urlKO; ?></p>
        <p><strong>DS_Merchant_Signature:</strong> <?php echo $signature; ?></p>
    </div>
</body>
</html>
