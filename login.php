<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $contrasena = $conn->real_escape_string($_POST['contrasena']);

    // Verificar en la tabla Registro
    $sql_login = "SELECT * FROM Registro WHERE `Numero de Control` = '$control' AND `Contraseña` = '$contrasena'";
    $result_login = $conn->query($sql_login);

    if ($result_login->num_rows > 0) {
        // ¿Es profesor?
        $sql_profesor = "SELECT * FROM Profesores WHERE `Numero de Control` = '$control'";
        $result_profesor = $conn->query($sql_profesor);

        if ($result_profesor->num_rows > 0) {
            // Redirigir a panel de profesor
            echo "<script>
                    alert('Bienvenido, profesor');
                    window.location.href = 'reportes.php';
                  </script>";
            exit;
        } else {
            // Es alumno, registrar entrada
            date_default_timezone_set("America/Mexico_City");
            $hora_entrada = date("Y-m-d H:i:s");

            // Obtener nombre y apellidos del alumno
            $sql_datos = "SELECT Nombre, Apellidos FROM Usuarios WHERE `Numero de Control` = '$control'";
            $result_datos = $conn->query($sql_datos);

            if ($result_datos->num_rows > 0) {
                $datos = $result_datos->fetch_assoc();
                $nombre = $datos['Nombre'];
                $apellidos = $datos['Apellidos'];

                // Insertar acceso
                $sql_acceso = "INSERT INTO acceso (`Numero de Control`, Nombre, Apellidos, H_Entrada)
                               VALUES ('$control', '$nombre', '$apellidos', '$hora_entrada')";

                if ($conn->query($sql_acceso) === TRUE) {
                    echo "<script>
                            alert('Bienvenido, alumno');
                            window.location.href = 'PaginaWeb.html?control=$control';
                          </script>";
                    exit;
                } else {
                    echo "Error al registrar acceso: " . $conn->error;
                }
            } else {
                echo "<script>
                        alert('Error: No se encontraron datos del alumno.');
                        window.location.href = 'index.php';
                      </script>";
            }
        }
    } else {
        echo "<script>
                alert('Credenciales incorrectas');
                window.location.href = 'index.php';
              </script>";
    }
}

$conn->close();
?>
