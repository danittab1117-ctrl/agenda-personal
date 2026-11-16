
<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}
require_once "config/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
    !isset($_SESSION["csrf_token"]) ||
    !isset($_POST["csrf_token"]) ||
    !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])
) {
    die("Solicitud no válida.");
}
    $nombre = trim($_POST["nombre"]);
    $telefono = trim($_POST["telefono"]);
    $correo = trim($_POST["correo"]);
    $direccion = trim($_POST["direccion"]);

    if ($nombre === "") {
        $mensaje = "El nombre es obligatorio.";
    } elseif ($correo !== "" && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no es válido.";
    } else {
        $consulta = $conexion->prepare(
            "INSERT INTO contactos (usuario_id, nombre, telefono, correo, direccion)
             VALUES (?, ?, ?, ?, ?)"
        );

        $consulta->execute([
            $_SESSION["usuario_id"],
            $nombre,
            $telefono,
            $correo,
            $direccion
        ]);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar contacto</title>
</head>
<body>

    <h2>Agregar nuevo contacto</h2>

    <p><?php echo htmlspecialchars($mensaje); ?></p>

    <form method="POST">
        <input type="hidden" name="csrf_token"
value="<?php echo htmlspecialchars($_SESSION["csrf_token"]); ?>">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono"><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo"><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="direccion"><br><br>

        <button type="submit">Guardar contacto</button>
    </form>

    <br>
    <a href="index.php">Volver a la agenda</a>

</body>
</html>
