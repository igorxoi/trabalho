<?php

require_once __DIR__ . '/../../core/Controller.php';

class CadastroController extends Controller {
	public function index($idVeiculo = null) {
		if(isset($idVeiculo)) {
			$this->alterar($idVeiculo);
		}

		require_once __DIR__ . '/../views/cadastro_veiculo.php';
	}

	public function alterar($idVeiculo) {
		$veiculoModel = $this->model('Estacionamento');
		$veiculo = $veiculoModel->buscarVeiculoPorId($idVeiculo);

		$this->view('cadastro_veiculo', ['veiculo' => $veiculo]);
	}
}