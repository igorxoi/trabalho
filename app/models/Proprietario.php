<?php

class Proprietario extends Model
{
  public function adicionar($nome, $telefone, $email)
  {
    $sql = "INSERT INTO proprietario (nome, telefone, email) VALUES (:nome, :telefone, :email)";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);

    return $stmt->execute() ? $this->db->lastInsertId() : false;
  }

  public function remover($id)
  {
    $sql = "DELETE FROM veiculo WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $veiculo_id);
    $stmt->execute();
  }
}
