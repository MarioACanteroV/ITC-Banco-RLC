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
$fecha_hoy = date("Y-m-d");

// Consulta registros cuya entrada sea hoy
$sql = "SELECT `Numero de Control`, Nombre, Apellidos, H_Entrada, H_Salida
        FROM acceso
        WHERE DATE(H_Entrada) = '$fecha_hoy'
        ORDER BY H_Entrada ASC";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte Diario</title>
<style>
  table {border-collapse: collapse; width: 90%; margin: 20px auto;}
  th, td {border: 1px solid #333; padding: 8px; text-align: center;}
  th {background-color: #007bff; color: white;}
</style>
</head>
<body>
<h1 style="text-align:center;">Reporte Diario - <?php echo $fecha_hoy; ?></h1>

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
      echo "<tr><td colspan='5'>No hay registros para hoy</td></tr>";
  }
  ?>
</table>
</body>
</html>
<?php $conn->close(); ?>
