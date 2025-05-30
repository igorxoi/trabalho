<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

date_default_timezone_set('America/Sao_Paulo');

class HistoricoController extends Controller
{
	public function index()
	{
		$this->buscar();
		require_once __DIR__ . '/../views/historico.php';
	}

	public function buscar()
	{
		$estacionamentoModel = $this->model('Estacionamento');
		$registros = $estacionamentoModel->buscarVeiculos();

		$dados = array_map(function ($item) {
			$dataInicio = $item['data_inicio_entrada'];
			$dataSaida = $item['status_data_fim'] ?: date('Y-m-d H:i:s');

			$dataEntrada = strtotime($dataInicio);
			$dataSaidaTimestamp = strtotime($dataSaida);

			$diferencaSegundos = abs($dataSaidaTimestamp - $dataEntrada);
			$horas = floor($diferencaSegundos / 3600);
			$minutos = floor(($diferencaSegundos % 3600) / 60);

			$valorTotal = calcularValorEstacionamento($horas, $minutos, $item);
			$dataFormatada = formatarDataHora($item['status_data_inicio']);

			return [
				'dataEntrada' => $dataFormatada['data'],
				'horaEntrada' => $dataFormatada['hora'],
				'tipoVagaId' => $item['tipo_vaga_id'],
				'vaga' => $item['vaga'],
				'placa' => $item['placa'],
				'modelo' => $item['modelo'],
				'proprietario' => $item['proprietario'],
				'descricao' => $item['descricao'],
				'tempoEstacionadoFormatado' => "{$horas}h {$minutos}m",
				'valorTotal' => formatarParaReais($valorTotal),
			];
		}, $registros);

		$this->view('historico', ['dados' => $dados]);
	}
}
