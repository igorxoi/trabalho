<?php

class StatusVeiculo extends Model
{
	public function adicionar($estacionamento_id)
	{
		$sql = "INSERT INTO status_estacionamento (estacionamento_id, status_id) VALUES (:estacionamento_id, 2);";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':estacionamento_id', $estacionamento_id);

		if ($stmt->execute()) return $this->db->lastInsertId();

		return false;
	}
}
