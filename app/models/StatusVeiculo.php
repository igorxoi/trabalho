<?php

require_once __DIR__ . '/../../core/Model.php';

class StatusVeiculo extends Model
{
	public function adicionar($registroEstacionamentoId, $statusId)
	{
		$params = [
			':registro_estacionamento_id' => $registroEstacionamentoId,
			':status_id' => $statusId,
		];

		if ($statusId === 1) {
			$params[':data_fim'] = date('Y-m-d H:i:s');
			$sql = "INSERT INTO 
								status_estacionamento (
									registro_estacionamento_id, 
									status_id, 
									data_fim) 
								VALUES (
									:registro_estacionamento_id, 
									:status_id, 
									:data_fim);";
		} else {
			$sql = "INSERT INTO status_estacionamento (registro_estacionamento_id, status_id) VALUES (:registro_estacionamento_id, :status_id);";
		}

		$stmt = $this->db->prepare($sql);

		foreach ($params as $key => $value) {
			$stmt->bindValue($key, $value);
		}

		return $stmt->execute() ? $this->db->lastInsertId() : false;
	}

	public function finalizar($idRegistroAtivo)
	{
		$dataHoraAtual = date('Y-m-d H:i:s');

		$sql = "UPDATE 
							status_estacionamento 
						SET 
							data_fim = :data_fim 
						WHERE 
							id = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':data_fim', $dataHoraAtual);
		$stmt->bindParam(':id', $idRegistroAtivo);

		return $stmt->execute() ? $idRegistroAtivo : false;
	}

	public function atualizarStatus($estacionamentoId, $statusId)
	{
		$idRegistroAtivo = $this->buscarPorEstacionamentoId($estacionamentoId);
		if (!$idRegistroAtivo) return false;

		$this->finalizar($idRegistroAtivo);
		return $this->adicionar($estacionamentoId, $statusId);
	}

	public function buscarPorEstacionamentoId($estacionamentoId)
	{
		$sql = "SELECT 
							* 
						FROM 
							status_estacionamento 
						WHERE 
							registro_estacionamento_id = :registro_estacionamento_id 
						AND 
							data_fim IS NULL";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':registro_estacionamento_id', $estacionamentoId);
		$stmt->execute();

		$registro = $stmt->fetch(PDO::FETCH_ASSOC);
		return $registro ? $registro['id'] : false;
	}
}
