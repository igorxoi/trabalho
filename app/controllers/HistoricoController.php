<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

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
			$dataFormatada = formatarDataHora($item['status_data_inicio']);

			$dataEntrada = strtotime($item['status_data_inicio']);
			$dataSaida = $item['data_fim'] ? strtotime($item['data_fim']) : time();

			$diferencaSegundos = abs($dataSaida - $dataEntrada);
			$horas = floor($diferencaSegundos / 3600);
			$minutos = floor(($diferencaSegundos % 3600) / 60);

			$valorTotal = calcularValorEstacionamento($horas, $minutos, $item);

			return [
				'dataEntrada' => $dataFormatada['data'],
				'dataSaida' => "",
				'horaEntrada' => $dataFormatada['hora'],
				'tipoVagaId' => $item['tipo_vaga_id'],
				'vaga' => $item['vaga'],
				'placa' => $item['placa'],
				'modelo' => $item['modelo'],
				'proprietario' => $item['proprietario'],
				'descricao' => $item['descricao'],
				'tempoEstacionadoFormatado' => "{$horas}h {$minutos}m",
				'valorTotal' => number_format($valorTotal, 2, '.', ''),
			];
		}, $registros);

		$this->view('historico', ['dados' => $dados]);
	}
}
