<?php

require_once __DIR__ . '/../../core/Model.php';

class User extends Model
{
	public function verificarCredenciais($email, $senha)
	{
		$sql = "SELECT * FROM usuario WHERE email = :email";

		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->execute();

		$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($usuario && password_verify($senha, $usuario['senha'])) {
			return $usuario;
		} else {
			return false;
		}
	}

	public function buscarPermissoes($usuarioId)
	{
		$stmt = $this->db->prepare("SELECT permissoes FROM usuario WHERE id = ?");
		$stmt->execute([$usuarioId]);
		return $stmt->fetchAll(PDO::FETCH_COLUMN);
	}
}
