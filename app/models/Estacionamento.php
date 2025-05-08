<?php

require_once __DIR__ . '/../../core/Model.php';

class Estacionamento extends Model {
    public function getAll() {
        $campos = "
            e.id,
            e.veiculo_id, 
            e.tipo_vaga_id, 
            e.vaga, 
            v.placa, 
            v.modelo, 
            v.marca, 
            v.cor, 
            p.nome, 
            p.telefone, 
            p.email, 
            t.valor, 
            t.data_inicio, 
            t.data_fim, 
            tv.tipo,
            s.descricao";

        $sql = "SELECT $campos 
                    FROM estacionamento AS e 
                        INNER JOIN veiculo AS v ON e.veiculo_id = v.id 
                        INNER JOIN tarifa as t ON e.tarifa_id = t.id 
                        INNER JOIN tipo_vaga AS tv ON e.tipo_vaga_id = tv.id
                        INNER JOIN proprietario AS p ON v.proprietario_id = p.id
                        INNER JOIN status_estacionamento AS se ON e.id = se.estacionamento_id 
                        INNER JOIN status AS s ON s.id = se.status_id;";

        $result = $this->db->query($sql);

        return $result->fetchAll();
    }
}