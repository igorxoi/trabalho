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

		if ($resultado['statusId'] == 4) {
			echo json_encode(['status' => 'sucesso', 'dados' => $resultado]);
			exit;
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

	public function darBaixa()
	{
		$id = $_POST['id'] ?? null;
		return $this->atualizarStatus($id, 4);
	}
}
