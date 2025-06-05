<?php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../helpers/utils.php';

class UsuarioController extends Controller
{
	public function cadastro()
	{
		require_once __DIR__ . '/../views/cadastro_usuario.php';
	}
}
