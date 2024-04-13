<?php
session_start();
include_once('connection.php');

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $telefono = $_POST['telefono'];
    $domicilio = $_POST['domicilio'];
    $genero = $_POST['genero'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $edad = calcular_edad($fecha_nacimiento);
    $password = $_POST['password'];

        $sql = "UPDATE usuarios SET telefono = '$telefono', domicilio = '$domicilio', genero = '$genero', fecha_nacimiento = '$fecha_nacimiento', edad = $edad, password = '$password' WHERE usuario = '$username'";
        if ($conn->query($sql) === TRUE) {
            echo "Se han actualizado los campos modificados";
        } else {
            echo "Error al actualizar los datos: " . $conn->error;
        }
    }

$sql = "SELECT * FROM usuarios WHERE usuario = '$username'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $telefono = $row['telefono'];
    $domicilio = $row['domicilio'];
    $genero = $row['genero'];
    $fecha_nacimiento = $row['fecha_nacimiento'];
    $edad = $row['edad'];
    $password = $row['password'];
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
    <title>Información del Perfil</title>
    <link rel="stylesheet" href="stylePerfil.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1>Configuración del Perfil</h1>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="MenuPrincipal.html">Menú Principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CasaEnVenta.html">Casas en Venta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CrearSubasta.html">Crear Subasta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Perfil.php">Ver Perfil</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="perfil-container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="campo">
                    <label for="nombre">Nombre del usuario:</label>
                    <input type="text" id="nombre" value="<?php echo $username; ?>" disabled>
                </div>
                <div class="campo">
                    <label for="telefono">Número de teléfono:</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
                </div>
                <div class="campo">
                    <label for="domicilio">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio" value="<?php echo $domicilio; ?>">
                </div>
                <div class="campo">
                    <label for="genero">Género:</label>
                    <select id="genero" name="genero">
                        <option value="masculino" <?php if ($genero == 'masculino') echo 'selected'; ?>>Masculino</option>
                        <option value="femenino" <?php if ($genero == 'femenino') echo 'selected'; ?>>Femenino</option>
                        <option value="otro" <?php if ($genero == 'otro') echo 'selected'; ?>>Otro</option>
                    </select>
                </div>
                <div class="campo">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" required>
                <div class="campo">
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" value="<?php echo $edad; ?>" readonly required>
                </div>
                <div class="campo">
                    <label for="password">Contraseña:</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" value="<?php echo $password; ?>">
                        <span class="mostrar-password" onclick="mostrarContrasena()">Mostrar</span>
                    </div>
                </div>
                <div class="campo">
                    <input type="submit" value="Guardar cambios">
                </div>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function previewImage() {
            var preview = document.getElementById('preview');
            var fileInput = document.getElementById('foto');
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(file);
        }

        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.classList.toggle("show-menu");
        }

        function mostrarContrasena() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function calcularEdad() {
        var fechaNacimiento = new Date(document.getElementById("fecha_nacimiento").value);
        var fechaActual = new Date();
        var edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
        document.getElementById("edad").value = edad;
        }
    </script>
</body>
</html>
