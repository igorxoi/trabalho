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
		$this->tarifaModel = new Tarifa();
		$this->statusVeiculoModel = new StatusVeiculo();
	}

	public function buscarVeiculosEstacionados()
	{
		$sql = "SELECT " . $this->getCamposConsulta() . "
				FROM registro_estacionamento AS re
				INNER JOIN tarifa AS t ON re.tarifa_id = t.id
				INNER JOIN tipo_vaga AS tv ON re.tipo_vaga_id = tv.id
				INNER JOIN status_estacionamento AS se ON re.id = se.registro_estacionamento_id
				INNER JOIN status AS s ON s.id = se.status_id
				WHERE se.data_fim IS NULL OR se.status_id IN (1, 4)
				ORDER BY re.id DESC";

		return $this->db->query($sql)->fetchAll();
	}

	public function adicionar($dados)
	{
		$sql = "INSERT INTO registro_estacionamento (
					proprietario, telefone, placa, modelo, marca, cor,
					tipo_vaga_id, tarifa_id, vaga
				) VALUES (
					:proprietario, :telefone, :placa, :modelo, :marca, :cor,
					:tipo_vaga_id, :tarifa_id, :vaga
				)";

		$stmt = $this->db->prepare($sql);
		$tarifaId = $this->tarifaModel->buscarAtiva($dados['tipo']);

		$this->bindDadosEstacionamento($stmt, $dados, $tarifaId);

		if (!$stmt->execute()) return false;

		$registroId = $this->db->lastInsertId();

		if (!$this->statusVeiculoModel->adicionar($registroId, 2)) {
			$this->remover($registroId);
			return false;
		}

		return $registroId;
	}

	public function alterar($dados, $id)
	{
		$sql = "UPDATE registro_estacionamento SET
					proprietario = :proprietario,
					telefone = :telefone,
					placa = :placa,
					modelo = :modelo,
					marca = :marca,
					cor = :cor,
					tipo_vaga_id = :tipo_vaga_id,
					tarifa_id = :tarifa_id,
					vaga = :vaga
				WHERE id = :id";

		$stmt = $this->db->prepare($sql);
		$tarifaId = $this->tarifaModel->buscarAtiva($dados['tipo']);

		$this->bindDadosEstacionamento($stmt, $dados, $tarifaId);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		return $stmt->execute() ? $id : false;
	}

	public function buscarVeiculoPorId($id)
	{
		$sql = "SELECT " . $this->getCamposConsulta(true) . "
				FROM registro_estacionamento AS re
				INNER JOIN tarifa AS t ON re.tarifa_id = t.id
				INNER JOIN tipo_vaga AS tv ON re.tipo_vaga_id = tv.id
				INNER JOIN status_estacionamento AS se ON re.id = se.registro_estacionamento_id
				INNER JOIN status AS s ON s.id = se.status_id
				WHERE re.id = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	private function remover(int $id)
	{
		$sql = "DELETE FROM registro_estacionamento WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
	}

	private function bindDadosEstacionamento($stmt, $dados, $tarifaId)
	{
		$stmt->bindParam(':proprietario', $dados['proprietario']);
		$stmt->bindParam(':telefone', $dados['telefone']);
		$stmt->bindParam(':placa', $dados['placa']);
		$stmt->bindParam(':modelo', $dados['modelo']);
		$stmt->bindParam(':marca', $dados['marca']);
		$stmt->bindParam(':cor', $dados['cor']);
		$stmt->bindParam(':tipo_vaga_id', $dados['tipo']);
		$stmt->bindParam(':tarifa_id', $tarifaId);
		$stmt->bindParam(':vaga', $dados['vaga']);
	}

	private function getCamposConsulta($comTarifas = false)
	{
		$campos = [
			"re.id",
			"re.tipo_vaga_id",
			"re.vaga",
			"re.placa",
			"re.modelo",
			"re.marca",
			"re.cor",
			"re.proprietario",
			"re.telefone",
			"t.data_inicio",
			"t.data_fim",
			"tv.tipo",
			"se.data_inicio AS status_data_inicio",
			"se.data_fim AS status_data_fim",
			"se.status_id",
			"s.descricao"
		];

		if ($comTarifas) {
			array_splice($campos, 10, 0, [
				"t.valor_primeira_hora",
				"t.valor_demais_horas"
			]);
		}

		return implode(",\n\t\t\t", $campos);
	}
}
