<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Cita.php';
require_once __DIR__ . '/../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);
$cliente = new Cliente($db);
$citas = $cita->listar();
$clientes = $cliente->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Citas</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
<h2>Bienvenido, <?php echo $_SESSION["usuario_nombre"]; ?></h2>
<a href="../logout.php" class="logOut">Cerrar sesión</a>

<h3>Nueva Cita</h3>
<form action="../controllers/citasController.php" method="POST">
    <input type="text" name="cliente_nombre" placeholder="Nombre del cliente" required>
    <input type="datetime-local" id="fechaHora" name="fechaHora" required>
    <input type="text" name="servicio" placeholder="Servicio" required>
    <button type="submit" name="crearCita">Guardar</button>
</form>

<h3>Listado de Citas</h3>
<table border="1">
    <tr><th>Cliente</th><th>Fecha</th><th>Hora</th><th>Servicio</th></tr>
    <?php while ($row = $citas->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $row['cliente'] ?></td>
            <td><?= $row['fecha'] ?></td>
            <td><?= $row['hora'] ?></td>
            <td><?= $row['servicio'] ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
