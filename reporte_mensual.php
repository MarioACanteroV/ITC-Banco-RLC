<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Banco-Pract";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

date_default_timezone_set("America/Mexico_City");
$mes_actual = date("Y-m"); // Ejemplo: 2025-05

// Consulta registros cuya entrada sea en el mes actual
$sql = "SELECT `Numero de Control`, Nombre, Apellidos, H_Entrada, H_Salida
        FROM acceso
        WHERE DATE_FORMAT(H_Entrada, '%Y-%m') = '$mes_actual'
        ORDER BY H_Entrada ASC";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte Mensual</title>
<style>
  table {border-collapse: collapse; width: 90%; margin: 20px auto;}
  th, td {border: 1px solid #333; padding: 8px; text-align: center;}
  th {background-color: #28a745; color: white;}
</style>
</head>
<body>
<h1 style="text-align:center;">Reporte Mensual - <?php echo $mes_actual; ?></h1>

<table>
  <tr>
    <th>Número de Control</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Hora Entrada</th>
    <th>Hora Salida</th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['Numero de Control']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
          echo "<td>" . htmlspecialchars($row['Apellidos']) . "</td>";
          echo "<td>" . $row['H_Entrada'] . "</td>";
          echo "<td>" . ($row['H_Salida'] ? $row['H_Salida'] : "Sin registrar") . "</td>";
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='5'>No hay registros para este mes</td></tr>";
  }
  ?>
</table>
</body>
</html>
<?php $conn->close(); ?>
