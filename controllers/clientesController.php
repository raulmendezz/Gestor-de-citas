<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crearCliente"])) {
        $cliente->nombre = $_POST["nombre"];
        $cliente->telefono = $_POST["telefono"];

        if ($cliente->crear()) {
            $_SESSION["mensaje"] = "Cliente agregado con éxito.";
        } else {
            $_SESSION["error"] = "Error al agregar el cliente.";
        }
        header("Location: ../views/clientes.php");
        exit;
    }
}
