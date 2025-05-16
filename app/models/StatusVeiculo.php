<?php

require_once __DIR__ . '/../../core/Model.php';

class StatusVeiculo extends Model
{
	public function adicionar($estacionamento_id, $status_id = 2)
	{
		$params = [
			':estacionamento_id' => $estacionamento_id,
			':status_id' => $status_id,
		];

		if ($status_id === 1) {
			$dataHoraAtual = date('Y-m-d H:i:s');
			$params[':data_fim'] = $dataHoraAtual;

			$sql = "INSERT INTO status_estacionamento (estacionamento_id, status_id, data_fim) VALUES (:estacionamento_id, :status_id, :data_fim);";
		} else {
			$sql = "INSERT INTO status_estacionamento (estacionamento_id, status_id) VALUES (:estacionamento_id, :status_id);";
		}

		$stmt = $this->db->prepare($sql);

		foreach ($params as $key => $value) {
			$stmt->bindValue($key, $value);
		}

		return $stmt->execute() ? $this->db->lastInsertId() : false;
	}

	public function alterar($idRegistroAtivo)
	{
		$dataHoraAtual = date('Y-m-d H:i:s');

		$sql = "UPDATE status_estacionamento SET data_fim = :data_fim WHERE id = :id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':data_fim', $dataHoraAtual);
		$stmt->bindParam(':id', $idRegistroAtivo);

		return $stmt->execute() ? $idRegistroAtivo : false;
	}

	public function cancelar($estacionamentoId)
	{
		$idRegistroAtivo = $this->buscarPorEstacionamentoId($estacionamentoId);

		$this->alterar($idRegistroAtivo);
		$this->adicionar($estacionamentoId, 1);
	}

	public function buscarPorEstacionamentoId($estacionamentoId)
	{
		$sql = "SELECT * FROM status_estacionamento WHERE estacionamento_id = :estacionamento_id AND data_fim IS NULL";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':estacionamento_id', $estacionamentoId);
		$stmt->execute();

		$tarifa = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($tarifa) {
			$id = $tarifa['id'];
			return $id;
		}

		return false;
	}
}
