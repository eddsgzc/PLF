<?php
session_start();
include_once('connection.php'); //conexion

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];
    $genero = $_POST['genero'];
    $edad = calcular_edad($fecha_nacimiento);


    $sql = "INSERT INTO usuarios (usuario, password, telefono, domicilio, genero, fecha_nacimiento, edad) VALUES ('$username', '$password', '$telefono', '$domicilio', '$genero', '$fecha_nacimiento', '$edad')";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        $error = "Error al crear la cuenta: " . $conn->error;
    }
}

function calcular_edad($fecha_nacimiento) {
    $fecha_actual = new DateTime();
    $fecha_nacimiento = new DateTime($fecha_nacimiento);
    $edad = $fecha_actual->diff($fecha_nacimiento);
    return $edad->y;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="bg-light py-4">
        <div class="container">
            <h1 class="text-center">Crea tu cuenta</h1>
        </div>
    </header>
    <main>
        <div class="container mt-5">
            <form action="" method="post" class="form">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Número de teléfono:</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="domicilio">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="genero">Género:</label>
                    <select id="genero" name="genero" class="form-control">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" onchange="calcularEdad()" required>
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" class="form-control" readonly required>
                </div>
                <div class="form-group text-center">
                    <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Crear Cuenta">
                </div>
            </form>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        </div>
    </main>
    <footer class="bg-light py-4">
        <div class="container text-center">
            <p>Derechos Reservados &copy; 2024</p>
        </div>
    </footer>
    <script>
        function calcularEdad() {
            var fechaNacimiento = new Date(document.getElementById("fecha_nacimiento").value);
            var fechaActual = new Date();
            var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
            document.getElementById("edad").value = edad;
        }
    </script>
</body>
</html>
