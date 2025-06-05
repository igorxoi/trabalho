<?php

require_once __DIR__ . '/../../core/Model.php';

class Usuario extends Model
{
  public function cadastrar($dados)
  {
    $sql = "INSERT INTO usuario (nome, email, senha, permissoes) VALUES (:nome, :email, :senha, :permissoes);";

    $stmt = $this->db->prepare($sql);
    $hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

    $stmt->bindParam(':nome', $dados['nome']);
    $stmt->bindParam(':email', $dados['email']);
    $stmt->bindParam(':senha', $hash);
    $stmt->bindParam(':permissoes', $dados['permissoes']);

    if ($stmt->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  public function buscarTodos()
  {
    $sql = "SELECT id, nome, email FROM usuario;";

    return $this->db->query($sql)->fetchAll();
  }

  public function deletar($id)
  {
    $sql = "DELETE FROM usuario WHERE id = :id;";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function buscarPorId($id)
  {
    $sql = "SELECT * FROM usuario WHERE id = :id;";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
      return false;
    }
  }

  public function alterar($id, $dados)
  {
    $sql = "UPDATE usuario SET nome = :nome, email = :email, permissoes = :permissoes";

    if (!empty($dados['senha'])) {
      $sql .= ", senha = :senha";
    }

    $sql .= " WHERE id = :id";

    $stmt = $this->db->prepare($sql);

    $stmt->bindParam(':nome', $dados['nome']);
    $stmt->bindParam(':email', $dados['email']);
    $stmt->bindParam(':permissoes', $dados['permissoes']);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if (!empty($dados['senha'])) {
      $hash = password_hash($dados['senha'], PASSWORD_DEFAULT);
      $stmt->bindParam(':senha', $hash);
    }

    if ($stmt->execute()) {
      return $this->buscarPorId($id);
    } else {
      return false;
    }
  }
}
