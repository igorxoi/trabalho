<?php

require_once __DIR__ . '/../../core/Controller.php';

class ConfiguracoesController extends Controller {
	public function index() {
		require_once __DIR__ . '/../views/configuracoes.php';
	}

	public function gerenciarVagas() {
		print_r($_POST);
	}
}