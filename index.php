<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión - Banco de Prácticas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #a1c4fd, #c2e9fb);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
            position: relative;
        }

        .login-container img {
            width: 80px;
            margin-bottom: 15px;
        }

        .login-container h2 {
            margin-bottom: 15px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .register-link {
            margin-top: 10px;
            font-size: 0.9em;
        }

        .register-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Modal (ventana emergente) */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="LITC.png" alt="ITC Logo">
    <h2>Banco de Prácticas RLC</h2>

    <!-- Login Form -->
    <form action="login.php" method="POST">
        <input type="text" name="control" placeholder="Número de Control" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>

    <div class="register-link">
        ¿No tienes cuenta? <a href="#" onclick="abrirModal()">Registrarse</a>
    </div>
</div>

<!-- Modal de Registro -->
<div id="registroModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2>Registro</h2>
        <form action="registro.php" method="POST">
            <input type="text" name="control" placeholder="Número de Control" required>
            <input type="text" name="nombre" placeholder="Nombre(s)" required>
            <input type="text" name="apellidos" placeholder="Apellidos" required>
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="text" name="carrera" placeholder="Carrera" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
    </div>
</div>

<script>
    function abrirModal() {
        document.getElementById('registroModal').style.display = 'block';
    }

    function cerrarModal() {
        document.getElementById('registroModal').style.display = 'none';
    }

    // Cierra el modal si haces clic fuera de él
    window.onclick = function(event) {
        var modal = document.getElementById('registroModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
