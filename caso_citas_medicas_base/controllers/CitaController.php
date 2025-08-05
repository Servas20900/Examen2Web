<?php
require_once __DIR__ . '/../app/models/Cita.php';

class CitaController {
    public function crear() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'recepcionista') {
            $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
            $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
            $hora = htmlspecialchars($_POST['hora'], ENT_QUOTES, 'UTF-8');
            $usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8');
            $cita = new Cita();
            try {
                if ($cita->crear($nombre, $fecha, $hora, $usuario)) {
                    header('Location: ../views/citas.php?success=1');
                } else {
                    header('Location: ../views/citas.php?error=1');
                }
            } catch (Exception $e) {
                header('Location: ../views/citas.php?error=1&msg=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }

    public function eliminar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['rol'] == 'admin') {
            try {
                $cita = new Cita();
                $cita->eliminar($_GET['id']);
                header('Location: ../views/citas.php?deleted=1');
            } catch (Exception $e) {
                header('Location: ../views/citas.php?error=1&msg=' . urlencode($e->getMessage()));
            }
            exit();
        }
    }
}

// Manejo de acciones por GET/POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['crear'])) {
    $controller = new CitaController();
    $controller->crear();
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['eliminar'])) {
    $controller = new CitaController();
    $controller->eliminar();
}
