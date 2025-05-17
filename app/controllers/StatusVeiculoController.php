<?php

session_start();
require_once __DIR__ . '/../../core/Controller.php';

class StatusVeiculoController extends Controller
{
	private function atualizarStatus($estacionamentoId, $novoStatusId)
	{
		$statusVeiculoModel = $this->model('StatusVeiculo');
		$resultado = $statusVeiculoModel->atualizarStatus($estacionamentoId, $novoStatusId);

		if ($resultado) {
			header("Location: index.php?url=estacionamento/gerenciar");
			exit;
		} else {
			echo "Veículo não encontrado ou erro ao atualizar status.";
		}
	}

	public function cancelar($estacionamentoId)
	{
		$this->atualizarStatus($estacionamentoId, 1);
	}

	public function liberar($estacionamentoId)
	{
		$this->atualizarStatus($estacionamentoId, 3);
	}

	public function darBaixa($estacionamentoId)
	{
		$this->atualizarStatus($estacionamentoId, 4);
	}
}
