<?php

class Veiculo extends Model
{
	public function adicionar($proprietario_id, $placa, $modelo, $marca, $cor)
	{
		$sql = "INSERT INTO veiculo (proprietario_id, placa, modelo, marca, cor) 
					VALUES(:proprietario_id, :placa, :modelo, :marca, :cor);";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':proprietario_id', $proprietario_id);
		$stmt->bindParam(':placa', $placa);
		$stmt->bindParam(':modelo', $modelo);
		$stmt->bindParam(':marca', $marca);
		$stmt->bindParam(':cor', $cor);

		if ($stmt->execute()) return $this->db->lastInsertId();

		return false;
	}

	public function remover($id)
	{
		$sql = "DELETE FROM proprietario WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
	}
}
