<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Banco-Pract";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $control = $conn->real_escape_string($_POST['control']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellidos = $conn->real_escape_string($_POST['apellidos']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $carrera = $conn->real_escape_string($_POST['carrera']);
    $contrasena = $conn->real_escape_string($_POST['contrasena']);

    if (preg_match('/^\d/', $correo)) {
        // Si el correo empieza con un número, es un alumno
        $sql_usuario = "INSERT INTO Usuarios (`Numero de Control`, Nombre, Apellidos, Correo, Carrera) 
                        VALUES ('$control', '$nombre', '$apellidos', '$correo', '$carrera')";
    } else {
        // Si el correo empieza con una letra, es un profesor
        $sql_usuario = "INSERT INTO Profesores (`Numero de Control`, Nombre, Apellidos, Correo, Carrera) 
                        VALUES ('$control', '$nombre', '$apellidos', '$correo', '$carrera')";
    }

    $sql_registro = "INSERT INTO Registro (`Numero de Control`, `Contraseña`) 
                     VALUES ('$control', '$contrasena')";

    if ($conn->query($sql_usuario) === TRUE && $conn->query($sql_registro) === TRUE) {
        echo "<script>
                alert('Registro exitoso.');
                window.location.href = 'index.php';
              </script>";
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

