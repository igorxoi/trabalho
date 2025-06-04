<?php

require_once __DIR__ . '/../../core/Controller.php';

class CadastroUsuarioController extends Controller
{
	public function index()
	{
		require_once __DIR__ . '/../views/cadastro_usuario.php';
	}
}
