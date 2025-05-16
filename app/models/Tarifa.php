<?php

class Tarifa extends Model
{
	public function buscarAtiva($tipo_vaga_id)
	{
		$sql = "SELECT * FROM tarifa WHERE tipo_vaga_id = :tipo_vaga_id AND data_fim IS NULL";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':tipo_vaga_id', $tipo_vaga_id);
		$stmt->execute();

		$tarifa = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($tarifa) {
			$id = $tarifa['id'];
			return $id;
		}

		return false;
	}

	public function finalizar($tipo_vaga_id)
	{
		$dataHoraAtual = date('Y-m-d H:i:s');

		$idRegistroAtivo = $this->buscarAtiva($tipo_vaga_id);

		if (!$idRegistroAtivo) {
			return false;
		}

		$sql = "UPDATE tarifa SET data_fim = :data_fim WHERE id = :id";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':data_fim', $dataHoraAtual);
		$stmt->bindParam(':id', $idRegistroAtivo);

		if ($stmt->execute()) return $idRegistroAtivo;

		return false;
	}
}
