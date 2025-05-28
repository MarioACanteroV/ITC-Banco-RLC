<?php
// reportes.php

// (Opcional) Validación de sesión, si manejas sesiones
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Reportes</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .ventana-flotante {
      width: 300px;
      padding: 20px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
      position: absolute;
      top: 20%;
      left: 50%;
      transform: translate(-50%, -20%);
      text-align: center;
    }

    .ventana-flotante h2 {
      margin-bottom: 20px;
    }

    .ventana-flotante button {
      width: 80%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      background-color: #007bff;
      color: white;
      font-weight: bold;
      cursor: pointer;
      border-radius: 5px;
    }

    .ventana-flotante button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="ventana-flotante">
  <h2>Panel de Reportes</h2>
  <button onclick="window.location.href='reporte_diario.php'">Reporte Diario</button>
  <button onclick="window.location.href='reporte_mensual.php'">Reporte Mensual</button>
</div>

</body>
</html>
