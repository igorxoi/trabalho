<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

class LoginController extends Controller
{
	public function index()
	{
		require_once __DIR__ . '/../views/login.php';
	}

	public function autenticacao()
	{
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$userModel = $this->model('User');
		$usuario = $userModel->verificarCredenciais($email, $senha);

		if (!$usuario) {
			return responderErro('Credenciais inválidas.');
		}

		$permissoes = $userModel->buscarPermissoes($usuario['id']);

		$_SESSION['usuario'] = [
			'id' => $usuario['id'],
			'nome' => $usuario['nome'],
			'permissoes' => $permissoes
		];

		redirect("estacionamento/gerenciar");
	}
}
