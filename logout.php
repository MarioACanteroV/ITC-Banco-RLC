<?php
session_start(); // Solo si usas sesiones
$numero_control = $_GET['control'];

$conn = new mysqli("localhost", "root", "", "Banco-Pract");
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

date_default_timezone_set("America/Mexico_City");
$hora_salida = date("Y-m-d H:i:s");

// Corrección: usar subconsulta para evitar error con ORDER BY en UPDATE
$sql = "UPDATE acceso 
        SET H_Salida = '$hora_salida' 
        WHERE id = (
            SELECT id FROM (
                SELECT id FROM acceso 
                WHERE `Numero de Control` = '$numero_control' AND H_Salida IS NULL 
                ORDER BY H_Entrada DESC 
                LIMIT 1
            ) AS sub
        )";

$conn->query($sql);
$conn->close();

session_destroy(); // si usas sesiones

// Redirige al inicio
header("Location: index.php");
exit;
?>
