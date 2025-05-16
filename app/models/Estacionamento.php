<?php

require_once __DIR__ . '/../../core/Model.php';

require_once 'Veiculo.php';
require_once 'Proprietario.php';
require_once 'StatusVeiculo.php';
require_once 'Tarifa.php';

class Estacionamento extends Model
{
	private $proprietarioModel;
	private $veiculoModel;
	private $statusVeiculoModel;
	private $tarifaModel;

	public function __construct()
	{
		parent::__construct();
		$this->proprietarioModel = new Proprietario();
		$this->veiculoModel = new Veiculo();
		$this->statusVeiculoModel = new StatusVeiculo();
		$this->tarifaModel = new Tarifa();
	}

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
			t.data_inicio, 
			t.data_fim, 
			tv.tipo,
			se.data_fim,
			s.descricao";
		// t.valor, 

		$sql = "SELECT 
							$campos 
						FROM estacionamento AS e 
						INNER JOIN veiculo AS v ON e.veiculo_id = v.id 
						INNER JOIN proprietario AS p ON v.proprietario_id = p.id
						INNER JOIN tarifa as t ON e.tarifa_id = t.id 
						INNER JOIN tipo_vaga AS tv ON e.tipo_vaga_id = tv.id
						INNER JOIN status_estacionamento AS se ON e.id = se.estacionamento_id 
						INNER JOIN status AS s ON s.id = se.status_id 
						WHERE 
							se.data_fim IS NULL 
							OR se.status_id IN (1, 4) 
						ORDER BY e.id DESC;";

		$result = $this->db->query($sql);

		return $result->fetchAll();
	}

	public function adicionarCarro($dados)
	{

		$proprietario_id = $this->proprietarioModel->adicionar($dados['proprietario'], $dados['telefone_proprietario'], 'igor@email');

		if (!$proprietario_id) {
			return false;
		}

		$veiculo_id = $this->veiculoModel->adicionar($proprietario_id, $dados['placa'], $dados['modelo'], $dados['marca'], $dados['cor']);

		if (!$veiculo_id) {
			$this->proprietarioModel->remover($proprietario_id);
			return false;
		}

		$estacionamento_id = $this->adicionarEstacionamento($dados['tipo'], $veiculo_id, $dados['vaga']);

		if (!$estacionamento_id) {
			$this->veiculoModel->remover($veiculo_id);
			$this->proprietarioModel->remover($proprietario_id);
			return false;
		}

		$status_id = $this->statusVeiculoModel->adicionar($estacionamento_id, 2);

		if (!$status_id) {
			$this->removerEstacionamento($estacionamento_id);
			$this->veiculoModel->remover($veiculo_id);
			$this->proprietarioModel->remover($proprietario_id);
			return false;
		}

		return $estacionamento_id;
	}

	private function adicionarEstacionamento($tipo_vaga_id, $veiculo_id, $vaga)
	{
		$tarifa_id = $this->tarifaModel->buscarAtiva($tipo_vaga_id);

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

	private function removerEstacionamento($estacionamento_id)
	{
		$sql = "DELETE FROM estacionamento WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':id', $estacionamento_id);
		$stmt->execute();
	}
}
