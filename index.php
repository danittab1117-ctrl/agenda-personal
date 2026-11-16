
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

$consulta = $conexion->prepare(
    "SELECT * FROM contactos WHERE usuario_id = ? ORDER BY id DESC"
);
$consulta->execute([$_SESSION["usuario_id"]]);
$contactos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi agenda personal</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <h1>Mi agenda personal</h1>

    <h3>Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario_nombre"]); ?></h3>

    <a href="agregar.php">Agregar contacto</a>
    |
    <a href="cerrar_sesion.php">Cerrar sesión</a>

    <h2>Mis contactos</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($contactos as $contacto): ?>
        <tr>
            <td><?php echo htmlspecialchars($contacto["nombre"]); ?></td>
            <td><?php echo htmlspecialchars($contacto["telefono"]); ?></td>
            <td><?php echo htmlspecialchars($contacto["correo"]); ?></td>
            <td><?php echo htmlspecialchars($contacto["direccion"]); ?></td>
            <td>
                <a href="editar.php?id=<?php echo $contacto["id"]; ?>">Editar</a>
                |
                <form action="eliminar.php" method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?php echo $contacto["id"]; ?>">

    <input type="hidden" name="csrf_token"
           value="<?php echo htmlspecialchars($_SESSION["csrf_token"]); ?>">

    <button type="submit" onclick="return confirm('¿Deseas eliminar este contacto?')">
        Eliminar
    </button>
</form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <?php if (empty($contactos)): ?>
        <p>Todavía no tienes contactos registrados.</p>
    <?php endif; ?>

</body>
</html>

