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
			'telefone_proprietario' => $_POST['telefone_proprietario'] ?? '',
			'nome' => $_POST['nome'] ?? '',
			'vaga' => $_POST['vaga'] ?? '',
		];

		$estacionamentoModel = $this->model('Estacionamento');
		$veiculo_id = $estacionamentoModel->adicionarCarro($dados);

		if ($veiculo_id) {
			header("Location: index.php?url=estacionamento/gerenciar");
			exit;
		} else {
			echo "Veiculo não cadastrado.";
		}
	}
}
