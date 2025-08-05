<?php
require_once __DIR__ . '/../app/models/User.php';

class AuthController {
    public $error = '';
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = filter_var($_POST['correo'] ?? '', FILTER_SANITIZE_EMAIL);
            $contrasena = htmlspecialchars($_POST['contrasena'] ?? '', ENT_QUOTES, 'UTF-8');

            $user = new User();
            if ($user->login($correo, $contrasena)) {
                header("Location: ../views/citas.php");
                exit();
            } else {
                $this->error = "Credenciales incorrectas.";
            }
        }
    }
}
