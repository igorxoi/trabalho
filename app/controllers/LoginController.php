<?php

require_once __DIR__ . '/../../core/Controller.php';

class LoginController extends Controller {
    public function index() {
        require_once __DIR__ . '/../views/login.php';
    }

    public function authenticate() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $userModel = $this->model('User');
        $user = $userModel->checkCredentials($email, $senha);
        
        if ($user) {
            header("Location: index.php?url=estacionamento/gerenciar");
            exit;
        } else {
            echo "Credenciais inválidas.";
        }
    }
}