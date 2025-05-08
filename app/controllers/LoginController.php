<?php

session_start();
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
            $permissions = $userModel->getPermissions($user['id']);

            $_SESSION['user'] = [
                'id' => $user['id'],
                'nome' => $user['nome'],
                'permissoes' => $permissions
            ];

            // print_r($_SESSION['user']['id']);
            // print_r($_SESSION['user']['nome']);

            // print_r($_SESSION['user']['permissoes'][0]);

            header("Location: index.php?url=estacionamento/gerenciar");
            exit;
        } else {
            echo "Credenciais inválidas.";
        }
    }
}