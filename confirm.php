<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product'];
    $description = "";
    $price = 0;

    switch ($product) {
        case "Producto1":
            $description = "Descripción del Producto 1";
            $price = 1000;
            break;
        case "Producto2":
            $description = "Descripción del Producto 2";
            $price = 2000;
            break;
        case "Producto3":
            $description = "Descripción del Producto 3";
            $price = 3000;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Confirmación de Pago</h1>
        <p>Producto: <?php echo $description; ?></p>
        <p>Precio: $<?php echo number_format($price / 100, 2); ?></p>
        <form action="process_payment.php" method="post">
            <input type="hidden" name="description" value="<?php echo $description; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <label for="name">Nombre y Apellidos:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Pago mediante Redsýs</button>
        </form>
    </div>
</body>
</html>
