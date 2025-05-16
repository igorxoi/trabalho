<?php

session_start();

function getStatusClass($descricao)
{
  $map = [
    'estacionado' => 'estacionado',
    'pronto para saída' => 'liberado',
    'baixa realizada' => 'baixa',
    'cancelado' => 'cancelado',
  ];

  return $map[strtolower($descricao)] ?? 'indefinido';
}

function getStatusIcon($descricao)
{
  $map = [
    'estacionado' => 'timer',
    'pronto para saída' => 'flag',
    'baixa realizada' => 'done_all',
    'cancelado' => 'close',
  ];

  return $map[strtolower($descricao)] ?? 'indefinido';
}

function getVehicleTypeIcon($tipo_vaga_id)
{
  $map = [
    'moto' => 'two_wheeler',
    'carro pequeno' => 'directions_car',
    'carro grande' => 'airport_shuttle',
    'caminhão' => 'local_shipping',
  ];

  return $map[mb_strtolower($tipo_vaga_id)] ?? 'indefinido';
}

function userHasPermission($item)
{
  if (!isset($_SESSION['user']['permissoes'][0])) {
    return false;
  }

  $permissoes = json_decode($_SESSION['user']['permissoes'][0], true);

  return isset($permissoes[$item]) && $permissoes[$item] === true;
}

function getItemMenuActive($item)
{
  $screen = explode('/', $_GET['url'])[0];
  return $screen == $item ? 'ativo' : '';
}

function formatarValorParaDecimal($valor)
{
  $valorLimpo = preg_replace('/[^0-9,\.]/', '', $valor);
  $valorSemMilhar = preg_replace('/\.(?=.*\,)/', '', $valorLimpo);
  $valorDecimal = str_replace(',', '.', $valorSemMilhar);

  return number_format((float)$valorDecimal, 2, '.', '');
}
