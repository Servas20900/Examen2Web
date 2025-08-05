<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../app/models/Cita.php';
$cita = new Cita();
$citas = $cita->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Citas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body class="container mt-4">

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Cita registrada correctamente.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Error al registrar la cita. Verifica los datos.</div>
    <?php endif; ?>

    <h2>Listado de Citas</h2>
    <a href="../logout.php" class="btn btn-danger mb-3">Cerrar sesión</a>

    <?php if ($_SESSION['rol'] != 'recepcionista'): ?>
    <table id="tablaCitas" class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $citas->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre_paciente'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['fecha'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['hora'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['estado'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($row['nombre_usuario'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <?php if ($_SESSION['rol'] == 'admin'): ?>
                        <a href="../controllers/CitaController.php?eliminar=true&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    <?php endif ?>
                </td>
            </tr>
            <?php endwhile ?>
        </tbody>
    </table>
    <?php endif; ?>

    <h3 class="mt-5">Registrar nueva cita</h3>
    <form method="POST" action="../controllers/CitaController.php?crear=true">
        <input name="nombre" class="form-control mb-2" placeholder="Nombre del paciente" required>
        <input type="date" name="fecha" class="form-control mb-2" required>
        <input type="time" name="hora" class="form-control mb-2" required>
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#tablaCitas').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
                }
            });
        });
    </script>
</body>
</html>
