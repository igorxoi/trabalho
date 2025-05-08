<?php

require_once __DIR__ . '/../../core/Model.php';

class Estacionamento extends Model {
    public function getAll() {
        $sql = "SELECT * FROM estacionamento";
        $result = $this->db->query($sql);

        return $result->fetchAll();
    }
}