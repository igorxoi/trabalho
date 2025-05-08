<?php

class Model {
	protected $db;

	public function __construct() {
		try {
			$this->db = new PDO('mysql:host=localhost;dbname=db_estaciona_aqui', 'root', 'root');
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Erro na conexão com o banco de dados: " . $e->getMessage();
		}
	}
}