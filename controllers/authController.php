<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Usuario.php';

$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registro
    if (isset($_POST["register"])) {
        $usuario->nombre = $_POST["nombre"];
        $usuario->email = $_POST["email"];
        $usuario->password = $_POST["password"];

        if ($usuario->registrar()) {
            $_SESSION["mensaje"] = "Usuario registrado con éxito. Ahora puedes iniciar sesión.";
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION["error"] = "Error al registrar usuario.";
            header("Location: ../index.php");
            exit;
        }
    }

    // Login
    if (isset($_POST["login"])) {
        $usuario->email = $_POST["email"];
        $usuario->password = $_POST["password"];

        $resultado = $usuario->login();

        if ($resultado) {
            $_SESSION["usuario_id"] = $resultado["id"];
            $_SESSION["usuario_nombre"] = $resultado["nombre"];
            header("Location: ../views/citas.php");
            exit;
        } else {
            $_SESSION["error"] = "Email o contraseña incorrectos.";
            header("Location: ../index.php");
            exit;
        }
    }
}
