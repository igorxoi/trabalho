<?php

require_once __DIR__ . '/../../core/Controller.php';

class ConfiguracoesController extends Controller
{
	public function index()
	{
		require_once __DIR__ . '/../views/configuracoes.php';
	}

	public function gerenciarVagas()
	{
		$dados = [
			'tipo_vaga_id' => $_POST['tipo'] ?? '',
			'valor_primeira_hora' => $_POST['valor_primeira_hora'] ?? '',
			'valor_demais_horas' => $_POST['valor_demais_horas'] ?? '',
		];

		$configuracoesModel = $this->model('Configuracoes');
		$tarifa_id = $configuracoesModel->adicionarTarifa($dados);

		if ($tarifa_id) {
			header("Location: index.php?url=configuracoes/index");
			exit;
		} else {
			echo "Credenciais inválidas.";
		}
	}
}
