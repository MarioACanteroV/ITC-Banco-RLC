<?php
$control = $_GET['control'];

$conn = new mysqli("localhost", "root", "", "Banco-Pract");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

date_default_timezone_set("America/Mexico_City");
$hora_salida = date("Y-m-d H:i:s");

// Actualiza el último registro SIN hora de salida
$sql = "UPDATE acceso
        SET H_Salida = '$hora_salida'
        WHERE `Numero de Control` = '$control'
        AND H_Salida IS NULL
        ORDER BY H_Entrada DESC
        LIMIT 1";

$conn->query($sql);
$conn->close();
?>
