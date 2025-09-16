<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Cita.php';

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);

if (isset($_POST["crearCita"])) {
    $fechaHora = $_POST["fechaHora"];
    list($fecha, $hora) = explode("T", $fechaHora);

    $cita->cliente = $_POST["cliente_nombre"]; 
    $cita->fecha = $fecha;
    $cita->hora = $hora;
    $cita->servicio = $_POST["servicio"];

    if ($cita->crear()) {
        $_SESSION["mensaje"] = "Cita creada con éxito.";
    } else {
        $_SESSION["error"] = "Error al crear la cita.";
    }
    header("Location: ../views/citas.php");
    exit;
}

