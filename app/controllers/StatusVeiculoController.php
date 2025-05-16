<?php

session_start();
require_once __DIR__ . '/../../core/Controller.php';

class StatusVeiculoController extends Controller {

	public function cancelar($estacionamento_id) {
		$statusVeiculoModel = $this->model('StatusVeiculo');
		$statusVeiculoModel->cancelar($estacionamento_id, 1);

		if ($statusVeiculoModel) {
			header("Location: index.php?url=estacionamento/gerenciar");
			exit;
		} else {
			echo "Veiculo não cadastrado.";
		}
	}
}