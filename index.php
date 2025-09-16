<?php
session_start();
$mensaje = "";
if (isset($_SESSION["mensaje"])) {
    $mensaje = $_SESSION["mensaje"];
    unset($_SESSION["mensaje"]);
}
if (isset($_SESSION["error"])) {
    $mensaje = $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Peluquería - Login/Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="public/js/index.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php if ($mensaje): ?>
                <div class="alert alert-info"><?= $mensaje ?></div>
            <?php endif; ?>

            <div class="card shadow">
                <div class="card-header text-center">
                    <h3>Gestión de Citas - Peluquería</h3>
                </div>
                <div class="card-body">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Registro</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        <!-- Formulario Login -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form action="controllers/authController.php" method="POST">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Contraseña</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary w-100">Iniciar Sesión</button>
                            </form>
                        </div>

                        <!-- Formulario Registro -->
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <form action="controllers/authController.php" method="POST">
                                <div class="mb-3">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Contraseña</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <button type="submit" name="register" class="btn btn-success w-100">Registrarse</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
