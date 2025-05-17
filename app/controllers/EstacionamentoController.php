<?php

require_once __DIR__ . '/../../core/Controller.php';

class EstacionamentoController extends Controller
{
	public function index()
	{
		$this->gerenciar();
		require_once __DIR__ . '/../views/gerenciar.php';
	}

	public function gerenciar()
	{
		$estacionamentoModel = $this->model('Estacionamento');
		$cards = $estacionamentoModel->buscarVeiculosEstacionados();

		$this->view('gerenciar', ['cards' => $cards]);
	}

	public function cadastrarVeiculo()
	{
		$dados = [
			'tipo' => $_POST['tipo'] ?? '',
			'placa' => $_POST['placa'] ?? '',
			'modelo' => $_POST['modelo'] ?? '',
			'marca' => $_POST['marca'] ?? '',
			'cor' => $_POST['cor'] ?? '',
			'proprietario' => $_POST['nome_proprietario'] ?? '',
			'telefone' => $_POST['telefone_proprietario'] ?? '',
			'vaga' => $_POST['vaga'] ?? '',
		];

		$estacionamentoModel = $this->model('Estacionamento');
		$veiculoId = $estacionamentoModel->adicionar($dados);

		if ($veiculoId) {
			header("Location: index.php?url=estacionamento/gerenciar");
			exit;
		} else {
			echo "Veiculo não cadastrado.";
		}
	}

	public function editarVeiculo($registroEstacionamentoId)
	{
		$dados = [
			'tipo' => $_POST['tipo'] ?? '',
			'placa' => $_POST['placa'] ?? '',
			'modelo' => $_POST['modelo'] ?? '',
			'marca' => $_POST['marca'] ?? '',
			'cor' => $_POST['cor'] ?? '',
			'proprietario' => $_POST['nome_proprietario'] ?? '',
			'telefone' => $_POST['telefone_proprietario'] ?? '',
			'nome' => $_POST['nome'] ?? '',
			'vaga' => $_POST['vaga'] ?? '',
		];

		$estacionamentoModel = $this->model('Estacionamento');
		$registroEstacionamentoId = $estacionamentoModel->alterar($dados, $registroEstacionamentoId);

		if ($registroEstacionamentoId) {
			header("Location: index.php?url=cadastro/index/$registroEstacionamentoId");
			exit;
		} else {
			echo "Veiculo não cadastrado.";
		}
	}
}
