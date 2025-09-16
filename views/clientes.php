<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../index.php");
    exit;
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);
$clientes = $cliente->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
</head>
<body>
<h2>Bienvenido, <?php echo $_SESSION["usuario_nombre"]; ?></h2>
<a href="../logout.php">Cerrar sesión</a>

<h3>Nuevo Cliente</h3>
<form action="../controllers/clientesController.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="telefono" placeholder="Teléfono" required>
    <button type="submit" name="crearCliente">Guardar</button>
</form>

<h3>Listado de Clientes</h3>
<table border="1">
    <tr><th>Nombre</th><th>Teléfono</th></tr>
    <?php while ($row = $clientes->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['telefono'] ?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
