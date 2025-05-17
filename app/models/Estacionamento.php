<?php

require_once __DIR__ . '/../../core/Model.php';

require_once 'StatusVeiculo.php';
require_once 'Tarifa.php';

class Estacionamento extends Model
{
	private $tarifaModel;
	private $statusVeiculoModel;

	public function __construct()
	{
		parent::__construct();
		$this->statusVeiculoModel = new StatusVeiculo();
		$this->tarifaModel = new Tarifa();
	}

	public function buscarVeiculosEstacionados()
	{
		$campos = "
			re.id,
			re.placa,
			re.modelo,
			re.marca,
			re.cor,
			re.vaga,
			re.proprietario,
			re.telefone,
			t.data_inicio,
			t.data_fim,
			tv.tipo,
			se.data_fim AS status_data_fim,
			s.descricao
    ";

		$sql = "SELECT 
							$campos 
            FROM registro_estacionamento AS re
            INNER JOIN tarifa AS t ON re.tarifa_id = t.id 
            INNER JOIN tipo_vaga AS tv ON re.tipo_vaga_id = tv.id
            INNER JOIN status_estacionamento AS se ON re.id = se.registro_estacionamento_id 
            INNER JOIN status AS s ON s.id = se.status_id 
            WHERE 
							se.data_fim IS NULL 
							OR se.status_id IN (1, 4)
            ORDER BY re.id DESC;";

		$result = $this->db->query($sql);

		return $result->fetchAll();
	}

	public function adicionar($dados)
	{
		$sql = "INSERT INTO 
							registro_estacionamento (
								proprietario, 
								telefone,
								placa, 
								modelo, 
								marca, 
								cor,
								tipo_vaga_id, 
								tarifa_id, 
								vaga) 
							VALUES (
								:proprietario, 
								:telefone,
								:placa, 
								:modelo, 
								:marca, 
								:cor,
								:tipo_vaga_id, 
								:tarifa_id, 
								:vaga)";

		$stmt = $this->db->prepare($sql);

		$tarifaId = $this->tarifaModel->buscarAtiva($dados['tipo']);

		$stmt->bindParam(':proprietario', $dados['proprietario']);
		$stmt->bindParam(':telefone', $dados['telefone']);
		$stmt->bindParam(':placa', $dados['placa']);
		$stmt->bindParam(':modelo', $dados['modelo']);
		$stmt->bindParam(':marca', $dados['marca']);
		$stmt->bindParam(':cor', $dados['cor']);
		$stmt->bindParam(':tipo_vaga_id', $dados['tipo']);
		$stmt->bindParam(':tarifa_id', $tarifaId);
		$stmt->bindParam(':vaga', $dados['vaga']);

		$registroEstacionamentoId = $stmt->execute() ? $this->db->lastInsertId() : false;

		if (!$registroEstacionamentoId) return false;

		$statusEstacionamentoId = $this->statusVeiculoModel->adicionar($registroEstacionamentoId, 2);

		if (!$statusEstacionamentoId) {
			$this->remover($registroEstacionamentoId);
			return false;
		}

		return $registroEstacionamentoId;
	}

	private function remover($estacionamentoId)
	{
		$sql = "DELETE FROM registro_estacionamento WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $estacionamentoId);
		$stmt->execute();
	}

	public function alterar($dados, $registroEstacionamentoId)
	{
		$sql = "UPDATE 
							registro_estacionamento 
						SET
							proprietario = :proprietario,
							telefone = :telefone,
							placa = :placa,
							modelo = :modelo,
							marca = :marca,
							cor = :cor,
							tipo_vaga_id = :tipo_vaga_id,
							tarifa_id = :tarifa_id,
							vaga = :vaga
    				WHERE 
							id = :id";

		$stmt = $this->db->prepare($sql);

		$tarifaId = $this->tarifaModel->buscarAtiva($dados['tipo']);

		$stmt->bindParam(':proprietario', $dados['proprietario']);
		$stmt->bindParam(':telefone', $dados['telefone']);
		$stmt->bindParam(':placa', $dados['placa']);
		$stmt->bindParam(':modelo', $dados['modelo']);
		$stmt->bindParam(':marca', $dados['marca']);
		$stmt->bindParam(':cor', $dados['cor']);
		$stmt->bindParam(':tipo_vaga_id', $dados['tipo']);
		$stmt->bindParam(':tarifa_id', $tarifaId);
		$stmt->bindParam(':vaga', $dados['vaga']);
		$stmt->bindParam(':id', $registroEstacionamentoId, PDO::PARAM_INT);

		return $stmt->execute() ? $registroEstacionamentoId : false;
	}

	public function buscarVeiculoPorId($idVeiculo)
	{
		$campos = "
			id,
			tipo_vaga_id, 
			vaga, 
			placa, 
			modelo, 
			marca, 
			cor, 
			proprietario, 
			telefone";

		$sql = "SELECT 
							$campos 
						FROM registro_estacionamento
						WHERE 
							id = :idVeiculo;";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':idVeiculo', $idVeiculo, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
