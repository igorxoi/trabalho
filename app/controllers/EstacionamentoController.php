<?php

require_once __DIR__ . '/../../core/Controller.php';

class EstacionamentoController extends Controller {
	public function gerenciar() {
		$estacionamentoModel = $this->model('Estacionamento');
		$cards = $estacionamentoModel->getAll();
		
		$this->view('gerenciar', ['cards' => $cards]);
	}
}