
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

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit;
}

$consulta = $conexion->prepare(
    "SELECT * FROM contactos WHERE id = ? AND usuario_id = ?"
);
$consulta->execute([$id, $_SESSION["usuario_id"]]);
$contacto = $consulta->fetch(PDO::FETCH_ASSOC);

if (!$contacto) {
    header("Location: index.php");
    exit;
}

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
        $actualizar = $conexion->prepare(
            "UPDATE contactos
             SET nombre = ?, telefono = ?, correo = ?, direccion = ?
             WHERE id = ? AND usuario_id = ?"
        );

        $actualizar->execute([
            $nombre,
            $telefono,
            $correo,
            $direccion,
            $id,
            $_SESSION["usuario_id"]
        ]);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <link rel="stylesheet" href="css/estilos.css">
<head>
    <meta charset="UTF-8">
    <title>Editar contacto</title>
</head>
<body>

    <h2>Editar contacto</h2>

    <p><?php echo htmlspecialchars($mensaje); ?></p>

    <form method="POST">
        <input type="hidden" name="csrf_token"
value="<?php echo htmlspecialchars($_SESSION["csrf_token"]); ?>">
        <label>Nombre:</label><br>
        <input type="text" name="nombre"
               value="<?php echo htmlspecialchars($contacto["nombre"]); ?>" required><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono"
               value="<?php echo htmlspecialchars($contacto["telefono"]); ?>"><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo"
               value="<?php echo htmlspecialchars($contacto["correo"]); ?>"><br><br>

        <label>Dirección:</label><br>
        <input type="text" name="direccion"
               value="<?php echo htmlspecialchars($contacto["direccion"]); ?>"><br><br>

        <button type="submit">Actualizar contacto</button>
    </form>

    <br>
    <a href="index.php">Volver a la agenda</a>

</body>
</html>
