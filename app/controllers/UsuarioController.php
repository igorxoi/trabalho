<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

class UsuarioController extends Controller
{
	public function cadastro()
	{
		require_once __DIR__ . '/../views/cadastro_usuario.php';
	}

	public function listar()
	{
		$usuarioModel = $this->model('Usuario');
		$usuarios = $usuarioModel->buscarTodos();

		$this->view('usuarios', ['usuarios' => $usuarios]);
	}

	public function alterar($id)
	{
		$usuarioModel = $this->model('Usuario');
		$dados = $usuarioModel->buscarPorId($id);

		$usuario = [
			'id' => $dados['id'],
			'nome' => $dados['nome'],
			'email' => $dados['email'],
			'permissoes' => json_decode($dados['permissoes'], true),
		];

		$this->view('cadastro_usuario', ['usuario' => $usuario]);
	}

	public function salvar()
	{
		$usuarioModel = $this->model('Usuario');

		$permissoes = [
			'dashboard' => !!isset($_POST['checkbox_dashboard']),
			'cadastro_veiculo' => !!isset($_POST['checkbox_cadastro_veiculo']),
			'gerenciamento' => !!isset($_POST['checkbox_gerenciar_estacionamento']),
			'historico' => !!isset($_POST['checkbox_historico']),
			'configuracoes' => !!isset($_POST['checkbox_configuracoes']),
			'cadastro_usuario' => !!isset($_POST['checkbox_cadastrar_usuario']),
		];

		$dados = [
			'nome' => $_POST['nome'],
			'email' => $_POST['email'],
			'senha' => $_POST['senha'],
			'permissoes' => json_encode($permissoes),
		];

		$id = $usuarioModel->cadastrar($dados);

		if (!$id) {
			return responderErro("Erro ao cadastrar usuário.");
		}

		redirect("usuario/listar");
	}

	public function editar($id)
	{
		if (!$id) {
			return responderErro("Erro ao cadastrar usuário.");
		}

		$usuarioModel = $this->model('Usuario');

		$permissoes = [
			'dashboard' => !!isset($_POST['checkbox_dashboard']),
			'cadastro_veiculo' => !!isset($_POST['checkbox_cadastro_veiculo']),
			'gerenciamento' => !!isset($_POST['checkbox_gerenciar_estacionamento']),
			'historico' => !!isset($_POST['checkbox_historico']),
			'configuracoes' => !!isset($_POST['checkbox_configuracoes']),
			'cadastro_usuario' => !!isset($_POST['checkbox_cadastrar_usuario']),
		];

		$dados = [
			'nome' => $_POST['nome'],
			'email' => $_POST['email'],
			'senha' => $_POST['senha'],
			'permissoes' => json_encode($permissoes),
		];

		$usuario = $usuarioModel->alterar($id, $dados);

		if (!$usuario) {
			return responderErro("Erro ao editar usuário.");
		}

		redirect("usuario/listar");

		exit;
	}

	public function deletar($id)
	{
		if (!$id) {
			return responderErro("Erro ao cadastrar usuário.");
		}

		$usuarioModel = $this->model('Usuario');
		$retorno = $usuarioModel->deletar($id);

		if (!$retorno) {
			return responderErro("Erro ao excluir usuário.");
		}

		redirect("usuario/listar");

		exit;
	}
}
