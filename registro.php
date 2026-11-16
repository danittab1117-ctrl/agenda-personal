
<?php
require_once "config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    if ($nombre == "" || !filter_var($correo, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        $mensaje = "Verifica los datos. La contraseña debe tener al menos 6 caracteres.";
    } else {
        $consulta = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $consulta->execute([$correo]);

        if ($consulta->fetch()) {
            $mensaje = "Este correo ya está registrado.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insertar = $conexion->prepare(
                "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)"
            );
            $insertar->execute([$nombre, $correo, $hash]);

            $mensaje = "¡Registro exitoso! Ya puedes iniciar sesión.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
</head>
<body>

    <h2>Crear una cuenta</h2>

    <p><?php echo htmlspecialchars($mensaje); ?></p>

    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo electrónico:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required minlength="6"><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p><a href="login.php">Iniciar sesión</a></p>

</body>
</html>
