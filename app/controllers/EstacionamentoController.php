<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

date_default_timezone_set('America/Sao_Paulo');

class EstacionamentoController extends Controller
{
	public function gerenciar()
	{
		require_once __DIR__ . '/../views/gerenciar.php';
	}

	public function historico()
	{
		require_once __DIR__ . '/../views/historico.php';
	}

	public function configuracoes()
	{
		require_once __DIR__ . '/../views/configuracoes.php';
	}

	public function dashboard()
	{
		require_once __DIR__ . '/../views/dashboard.php';
	}
}
