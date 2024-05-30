<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    echo '<h1>Datos de la Transacción</h1>';
    echo '<pre>';
    print_r($data);
    echo '</pre>';
} else {
    echo 'Método no permitido';
}
?>