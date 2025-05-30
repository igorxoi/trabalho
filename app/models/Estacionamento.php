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

	public function buscarVeiculos($filtrarEstacionados = false)
	{
		$sql = "
			SELECT 
				" . $this->getCamposConsulta(true) . ",
				(
					SELECT se1.data_inicio
					FROM status_estacionamento se1
					WHERE se1.status_id = 2 AND se1.registro_estacionamento_id = re.id
					ORDER BY se1.data_inicio DESC
					LIMIT 1
				) AS data_inicio_entrada,
				(
					SELECT se2.data_fim
					FROM status_estacionamento se2
					WHERE se2.data_fim IS NOT NULL AND se2.registro_estacionamento_id = re.id
					ORDER BY se2.data_inicio DESC
					LIMIT 1
				) AS ultima_data_saida
			FROM registro_estacionamento AS re
			INNER JOIN tarifa AS t ON re.tarifa_id = t.id
			INNER JOIN tipo_vaga AS tv ON re.tipo_vaga_id = tv.id
			INNER JOIN (
				SELECT se.*
				FROM status_estacionamento se
				WHERE (se.registro_estacionamento_id, se.data_inicio) 
				IN(
					SELECT registro_estacionamento_id, MAX(data_inicio)
					FROM status_estacionamento
					GROUP BY registro_estacionamento_id
				)
			) AS ultimo_status ON ultimo_status.registro_estacionamento_id = re.id
			INNER JOIN status AS s ON s.id = ultimo_status.status_id
			" . ($filtrarEstacionados ? "WHERE ultimo_status.status_id IN (2, 3)" : "") . "
			ORDER BY re.id DESC
		";

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
            INNER JOIN(
							SELECT se1.*
							FROM status_estacionamento se1
							INNER JOIN(
								SELECT registro_estacionamento_id, MAX(data_inicio) AS max_data_inicio
								FROM status_estacionamento
								GROUP BY registro_estacionamento_id) se2 
								ON se1.registro_estacionamento_id = se2.registro_estacionamento_id
								AND se1.data_inicio = se2.max_data_inicio
            	) AS ultimo_status ON ultimo_status.registro_estacionamento_id = re.id
            INNER JOIN status AS s ON s.id = ultimo_status.status_id
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
			"ultimo_status.data_inicio AS status_data_inicio",
			"ultimo_status.data_fim AS status_data_fim",
			"ultimo_status.status_id",
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
