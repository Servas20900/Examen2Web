<?php
require_once __DIR__ . '/../controllers/AuthController.php';

$controller = new AuthController();
$controller->login();
$error = $controller->error;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Citas Médicas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Iniciar sesión</h2>
    <h3 class="mb-4">correos: admin@demo.com y recepcionista@demo.com</h3>

    <h3 class="mb-4">passw: 123456</h3>


    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" required>
        </div>

        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contraseña" required>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
</body>
</html>
