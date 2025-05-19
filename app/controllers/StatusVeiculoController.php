<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

class StatusVeiculoController extends Controller
{
	private function atualizarStatus($estacionamentoId, $novoStatusId)
	{
		$statusVeiculoModel = $this->model('StatusVeiculo');
		$resultado = $statusVeiculoModel->atualizarStatus($estacionamentoId, $novoStatusId);

		if (!$resultado) {
			return responderErro("Veículo não encontrado ou erro ao atualizar status.");
		}

		redirect("estacionamento/gerenciar");
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
