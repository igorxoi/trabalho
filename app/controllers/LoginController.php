<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

class LoginController extends Controller
{
	public function index()
	{
		require_once __DIR__ . '/../views/login.php';
	}

	public function authenticate()
	{
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$userModel = $this->model('User');
		$user = $userModel->checkCredentials($email, $senha);

		if (!$user) {
			return responderErro('Credenciais inválidas.');
		}

		$permissions = $userModel->getPermissions($user['id']);

		$_SESSION['user'] = [
			'id' => $user['id'],
			'nome' => $user['nome'],
			'permissoes' => $permissions
		];

		redirect("estacionamento/gerenciar");
	}
}
