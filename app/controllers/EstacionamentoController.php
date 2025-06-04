<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

date_default_timezone_set('America/Sao_Paulo');

class EstacionamentoController extends Controller
{
	public function index()
	{
		require_once __DIR__ . '/../views/gerenciar.php';
	}
}
