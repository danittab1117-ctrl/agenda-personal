
<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit;
}

require_once "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

   if (
    !isset($_SESSION["csrf_token"]) ||
    !isset($_POST["csrf_token"]) ||
    !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])
) {
    die("Solicitud no válida.");
}

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {
        $consulta = $conexion->prepare(
            "DELETE FROM contactos WHERE id = ? AND usuario_id = ?"
        );

        $consulta->execute([$id, $_SESSION["usuario_id"]]);
    }
}

header("Location: index.php");
exit;

