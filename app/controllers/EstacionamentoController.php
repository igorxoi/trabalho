<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

date_default_timezone_set('America/Sao_Paulo');

class EstacionamentoController extends Controller
{
	public function index()
	{
		$this->gerenciar();
		require_once __DIR__ . '/../views/gerenciar.php';
	}

	public function gerenciar()
	{
		$estacionamentoModel = $this->model('Estacionamento');
		$registros = $estacionamentoModel->buscarVeiculos(true);

		$cards = array_map(function ($card) {
			$dataFormatada = formatarDataHora($card['status_data_inicio']);

			$dataEntrada = strtotime($card['status_data_inicio']);
			$dataSaida = time();

			$diferencaSegundos = abs($dataSaida - $dataEntrada);
			$horas = floor($diferencaSegundos / 3600);
			$minutos = floor(($diferencaSegundos % 3600) / 60);

			$valorTotal = calcularValorEstacionamento($horas, $minutos, $card);

			return [
				'id' => $card['id'],
				'dataEntrada' => $dataFormatada['data'],
				'dataSaida' => "",
				'horaEntrada' => $dataFormatada['hora'],
				'tipoVagaId' => $card['tipo_vaga_id'],
				'vaga' => $card['vaga'],
				'tipo' => $card['tipo'],
				'status_id' => intval($card['status_id']),
				'status_data_formatada' => $dataFormatada['data'],
				'status_hora_formatada' => $dataFormatada['hora'],
				'placa' => $card['placa'],
				'modelo' => $card['modelo'],
				'proprietario' => $card['proprietario'],
				'descricao' => $card['descricao'],
				'tempoEstacionadoFormatado' => "{$horas}h {$minutos}m",
				'valorTotal' => formatarParaReais($valorTotal),
			];
		}, $registros);

		$this->view('gerenciar', ['cards' => $cards]);
	}

	public function cadastrarVeiculo()
	{
		$dados = $this->extrairDadosVeiculo($_POST);

		$estacionamentoModel = $this->model('Estacionamento');
		$veiculoId = $estacionamentoModel->adicionar($dados);

		if ($veiculoId) {
			redirect('estacionamento/gerenciar');
		}

		echo "Veículo não cadastrado.";
	}

	public function editarVeiculo($registroEstacionamentoId)
	{
		$dados = $this->extrairDadosVeiculo($_POST);

		$estacionamentoModel = $this->model('Estacionamento');
		$resultado = $estacionamentoModel->alterar($dados, $registroEstacionamentoId);

		if ($resultado) {
			redirect("cadastro/index/$registroEstacionamentoId");
		}

		echo "Veículo não atualizado.";
	}

	public function buscarVeiculoPorId()
	{
		$id = $_POST['id'] ?? null;

		if (!$id) {
			return responderErro('ID não informado');
		}

		$estacionamentoModel = $this->model('Estacionamento');
		$dados = $estacionamentoModel->buscarVeiculoPorId($id);

		if (!$dados) {
			return responderErro('Veículo não encontrado');
		}

		$dataEntrada = strtotime($dados['status_data_inicio']);
		$dataSaida = time();

		$diferencaSegundos = abs($dataSaida - $dataEntrada);
		$horas = floor($diferencaSegundos / 3600);
		$minutos = floor(($diferencaSegundos % 3600) / 60);

		$valorTotal = calcularValorEstacionamento($horas, $minutos, $dados);

		$dataEntradaFmt = formatarDataHora($dados['status_data_inicio']);
		$dataSaidaFmt = formatarDataHora(date('Y-m-d H:i:s', $dataSaida));

		$veiculo = [
			'id' => $dados['id'],
			'tipoVagaId' => $dados['tipo_vaga_id'],
			'vaga' => $dados['vaga'],
			'placa' => $dados['placa'],
			'modelo' => $dados['modelo'],
			'proprietario' => $dados['proprietario'],
			'dataEntrada' => "$dataEntradaFmt[data] às $dataEntradaFmt[hora]",
			'dataSaida' => "$dataSaidaFmt[data] às $dataSaidaFmt[hora]",
			'tempoEstacionadoFormatado' => "{$horas}h {$minutos}m",
			'valorTotal' => formatarParaReais($valorTotal),
			'valorPrimeiraHora' => formatarParaReais($dados['valor_primeira_hora']),
			'valorDemaisHoras' => formatarParaReais($dados['valor_demais_horas']),
		];
		echo json_encode(['status' => 'sucesso', 'dados' => $veiculo]);
	}

	private function extrairDadosVeiculo($input)
	{
		$dados = [
			'tipo' => $input['tipo'] ?? '',
			'placa' => $input['placa'] ?? '',
			'modelo' => $input['modelo'] ?? '',
			'marca' => $input['marca'] ?? '',
			'cor' => $input['cor'] ?? '',
			'proprietario' => $input['nome_proprietario'] ?? '',
			'telefone' => $input['telefone_proprietario'] ?? '',
			'vaga' => $input['vaga'] ?? '',
		];

		return $dados;
	}
}
