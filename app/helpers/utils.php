<?php

function getStatusClass($descricao) {
  $map = [
    'estacionado' => 'estacionado',
    'pronto para saída' => 'liberado',
    'baixa realizada' => 'baixa',
    'cancelado' => 'cancelado',
  ];

  return $map[strtolower($descricao)] ?? 'indefinido';
}

function getStatusIcon($descricao) {
  $map = [
    'estacionado' => 'timer',
    'pronto para saída' => 'flag',
    'baixa realizada' => 'done_all',
    'cancelado' => 'close',
  ];

  return $map[strtolower($descricao)] ?? 'indefinido';
}

function getVehicleTypeIcon($tipo_vaga_id) {
  $map = [
    'moto' => 'two_wheeler',
    'carro pequeno' => 'directions_car',
    'carro grande' => 'airport_shuttle',
    'caminhão' => 'local_shipping',
  ];

  return $map[mb_strtolower($tipo_vaga_id)] ?? 'indefinido';
}
