<?php
require_once __DIR__ . '/../config/db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function login($correo, $password) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result && password_verify($password, $result['contrasena'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario'] = $result['usuario'];
            $_SESSION['rol'] = $result['rol'];
            return true;
        }
        return false;
    }
}
