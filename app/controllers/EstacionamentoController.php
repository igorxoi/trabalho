<?php

require_once __DIR__ . '/../../core/Controller.php';

class EstacionamentoController extends Controller {
	public function index() {
		$this->gerenciar();
		require_once __DIR__ . '/../views/gerenciar.php';
	}

	public function gerenciar() {
		$estacionamentoModel = $this->model('Estacionamento');
		$cards = $estacionamentoModel->getAll();
		
		$this->view('gerenciar', ['cards' => $cards]);
	}
}