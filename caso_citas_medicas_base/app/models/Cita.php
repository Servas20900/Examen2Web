<?php
require_once __DIR__ . '/../config/db.php';

class Cita {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function obtenerTodas() {
        return $this->db->query("SELECT * FROM citas");
    }

    public function crear($nombre, $fecha, $hora, $usuario) {
        // Validación básica
        if (empty($nombre) || empty($fecha) || empty($hora) || empty($usuario)) {
            return false;
        }
        // Validar formato de fecha y hora
        $fechaValida = preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha);
        $horaValida = preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $hora);
        if (!$fechaValida || !$horaValida) {
            return false;
        }
        $stmt = $this->db->prepare("INSERT INTO citas (nombre_paciente, fecha, hora, nombre_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $fecha, $hora, $usuario);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM citas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
