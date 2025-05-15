<?php

require_once __DIR__ . '/../../core/Model.php';

class Estacionamento extends Model
{
	public function buscarVeiculosEstacionados()
	{
		$campos = "
			e.id,
			e.veiculo_id, 
			e.tipo_vaga_id, 
			e.vaga, 
			v.placa, 
			v.modelo, 
			v.marca, 
			v.cor, 
			p.nome, 
			p.telefone, 
			p.email, 
			t.valor, 
			t.data_inicio, 
			t.data_fim, 
			tv.tipo,
			s.descricao";

		$sql = "SELECT $campos 
							FROM estacionamento AS e 
								INNER JOIN veiculo AS v ON e.veiculo_id = v.id 
								INNER JOIN proprietario AS p ON v.proprietario_id = p.id
								INNER JOIN tarifa as t ON e.tarifa_id = t.id 
								INNER JOIN tipo_vaga AS tv ON e.tipo_vaga_id = tv.id
								INNER JOIN status_estacionamento AS se ON e.id = se.estacionamento_id 
								INNER JOIN status AS s ON s.id = se.status_id ORDER BY e.id DESC;";

		$result = $this->db->query($sql);

		return $result->fetchAll();
	}

	public function adicionarCarro($dados)
	{
		$proprietario_id = $this->adicionarProprietario($dados['proprietario'], $dados['telefone_proprietario'], 'igor@email');

		if (!$proprietario_id) {
			return false;
		}

		$veiculo_id = $this->adicionarVeiculo($proprietario_id, $dados['placa'], $dados['modelo'], $dados['marca'], $dados['cor']);

		if (!$veiculo_id) {
			$this->removerProprietario($proprietario_id);
			return false;
		}

		$estacionamento_id = $this->adicionarEstacionamento($dados['tipo'], $veiculo_id, $dados['vaga']);

		if (!$estacionamento_id) {
			$this->removerVeiculo($veiculo_id);
			$this->removerProprietario($proprietario_id);
			return false;
		}

		$status_id = $this->adicionarStatus($estacionamento_id);

		if (!$status_id) {
			$this->removerEstacionamento($estacionamento_id);
			$this->removerVeiculo($veiculo_id);
			$this->removerProprietario($proprietario_id);
			return false;
		}

		return $estacionamento_id;
	}

	private function removerVeiculo($veiculo_id)
	{
		$sql = "DELETE FROM veiculo WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $veiculo_id);
		$stmt->execute();
	}

	private function adicionarProprietario($nome, $telefone, $email)
	{
		$sql = "INSERT INTO proprietario (nome, telefone, email) VALUES (:nome, :telefone, :email);";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':telefone', $telefone);
		$stmt->bindParam(':email', $email);

		if ($stmt->execute()) {
			return $this->db->lastInsertId();
		} else {
			return false;
		}
	}

	private function removerProprietario($proprietario_id)
	{
		$sql = "DELETE FROM proprietario WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $proprietario_id);
		$stmt->execute();
	}

	private function adicionarVeiculo($proprietario_id, $placa, $modelo, $marca, $cor)
	{
		$sql = "INSERT INTO veiculo (proprietario_id, placa, modelo, marca, cor) 
					VALUES(:proprietario_id, :placa, :modelo, :marca, :cor);";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':proprietario_id', $proprietario_id);
		$stmt->bindParam(':placa', $placa);
		$stmt->bindParam(':modelo', $modelo);
		$stmt->bindParam(':marca', $marca);
		$stmt->bindParam(':cor', $cor);

		if ($stmt->execute()) {
			return $this->db->lastInsertId();
		} else {
			return false;
		}
	}

	private function adicionarEstacionamento($tipo_vaga_id, $veiculo_id, $vaga)
	{
		$tarifa_id = $this->buscarTarifaAtiva($tipo_vaga_id);

		$sql = "INSERT INTO estacionamento (tipo_vaga_id, veiculo_id, tarifa_id, vaga) VALUES (:tipo_vaga_id, :veiculo_id, :tarifa_id, :vaga);";

		$stmt = $this->db->prepare($sql);

		$stmt->bindParam(':tipo_vaga_id', $tipo_vaga_id);
		$stmt->bindParam(':veiculo_id', $veiculo_id);
		$stmt->bindParam(':tarifa_id', $tarifa_id);
		$stmt->bindParam(':vaga', $vaga);

		if ($stmt->execute()) {
			return $this->db->lastInsertId();
		} else {
			return false;
		}
	}

	private function buscarTarifaAtiva($tipo_vaga_id)
	{
		$sql = "SELECT * FROM tarifa WHERE tipo_vaga_id = :tipo_vaga_id AND data_fim IS NULL";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':tipo_vaga_id', $tipo_vaga_id);
		$stmt->execute();

		$tarifa = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($tarifa) {
			$id = $tarifa['id'];
			return $id;
		} else {
			return false;
		}
	}

	private function adicionarStatus($estacionamento_id)
	{
		$sql = "INSERT INTO status_estacionamento (estacionamento_id, status_id) VALUES (:estacionamento_id, 2);";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':estacionamento_id', $estacionamento_id);

		if ($stmt->execute()) {
			return $this->db->lastInsertId();
		} else {
			return false;
		}
	}

	private function removerEstacionamento($estacionamento_id)
	{
		$sql = "DELETE FROM estacionamento WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $estacionamento_id);
		$stmt->execute();
	}
}
