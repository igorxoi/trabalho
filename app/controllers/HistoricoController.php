<?php

require_once __DIR__ . '/../../core/Controller.php';

class HistoricoController extends Controller {
	public function index() {
		require_once __DIR__ . '/../views/historico.php';
	}
}