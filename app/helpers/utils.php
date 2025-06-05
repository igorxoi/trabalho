<?php

session_start();

function verificarPermissaoItemMenu($item)
{
  if (!isset($_SESSION['usuario']['permissoes'][0])) {
    return false;
  }

  $permissoes = json_decode($_SESSION['usuario']['permissoes'][0], true);

  return isset($permissoes[$item]) && $permissoes[$item] === true;
}

function verificarMenuAtivo($item)
{
  return $_GET['url'] == $item ? 'ativo' : '';
}

function redirect($url)
{
  header("Location: index.php?url={$url}");
  exit;
}

function responderErro($mensagem)
{
  echo json_encode(['status' => 'erro', 'mensagem' => $mensagem]);
}

