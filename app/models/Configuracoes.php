<?php

require_once __DIR__ . '/../../core/Model.php';
require_once __DIR__ . '/../helpers/utils.php';

require_once 'Tarifa.php';

class Configuracoes extends Model
{

  private $tarifaModel;

  public function __construct()
  {
    parent::__construct();
    $this->tarifaModel = new Tarifa();
  }

  public function adicionarTarifa($dados)
  {
    $this->tarifaModel->finalizar($dados['tipo_vaga_id']);

    $sql = "INSERT INTO tarifa (tipo_vaga_id, valor_primeira_hora, valor_demais_horas) VALUES (:tipo_vaga_id, :valor_primeira_hora, :valor_demais_horas);";

    $valorPrimeiraHora = formatarValorParaDecimal($dados['valor_primeira_hora']);
    $valorDemaisHoras = formatarValorParaDecimal($dados['valor_demais_horas']);


    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':tipo_vaga_id', $dados['tipo_vaga_id']);
    $stmt->bindParam(':valor_primeira_hora', $valorPrimeiraHora);
    $stmt->bindParam(':valor_demais_horas', $valorDemaisHoras);

    if ($stmt->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }
}
