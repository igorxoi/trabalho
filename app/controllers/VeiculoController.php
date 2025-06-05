<?php

require_once __DIR__ . '/../../core/Controller.php';

class VeiculoController extends Controller
{
	public function cadastro()
	{
		require_once __DIR__ . '/../views/cadastro_veiculo.php';
	}
}
