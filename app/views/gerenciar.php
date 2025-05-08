<?php require_once(__DIR__ . '/../helpers/utils.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=.sliderbar, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    />
    <title>Gerenciar Estacionamento</title>
  </head>
  <body>
    <nav class="sidebar">
      <div class="logo">
        <img src="" alt="Logo" />
      </div>
      <ul class="menu">
        <a href="index.html">
          <li class="item-menu">
            <i class="material-symbols-outlined">dashboard</i>
            <span>Dashboard</span>
          </li>
        </a>
        <a href="cadastro.html">
          <li class="item-menu">
            <i class="material-symbols-outlined">add</i>
            <span>Cadastro de Veículo</span>
          </li>
        </a>
        <a href="gerenciar.html">
          <li class="item-menu ativo">
            <i class="material-symbols-outlined">car_gear</i>
            <span>Gerenciar Estacionamento</span>
          </li>
        </a>
        <a href="historico.html">
          <li class="item-menu">
            <i class="material-symbols-outlined">lists</i>
            <span>Histórico</span>
          </li>
        </a>
        <a href="configuracoes.html">
          <li class="item-menu">
            <i class="material-symbols-outlined">settings</i>
            <span>Configurações</span>
          </li>
        </a>
        <li class="logout" onclick="expandirMenu()">
          <i class="material-symbols-outlined icon-menu">arrow_menu_open</i>
          <span>Recolher</span>
        </li>
      </ul>
    </nav>
    <main class="main--container">
      <header class="header--conteudo">
        <div class="header--titulo">
          <h1>Gerenciar Estacionamento</h1>
          <span class="header--subtitulo"></span>
        </div>
      </header>
      <div class="card--container">
        <div class="card--conteudo">

          <?php foreach ($cards as $card): ?>
            <div class="card">
              <div class="veiculo-info">
                <span class="tipo-veiculo">
                  <i class="material-symbols-outlined"><?php echo getVehicleTypeIcon($card['tipo']); ?></i>
                </span>
                <div class="detalhes-veiculo">
                  <span class="status <?php echo getStatusClass($card['descricao']); ?>">
                    <span class="material-symbols-outlined"><?php echo getStatusIcon($card['descricao']); ?></span>
                    <?php echo($card['descricao']); ?>
                  </span>
                  <span class="nome-condutor"><?php echo($card['nome']); ?></span> 
                  <span class="mais-detalhes"><?php echo($card['modelo'].' / '.$card['placa']); ?></span>
                </div>
              </div>

              <div class="mais-detalhes">
                <span>Qua, 12 Jul 2025</span>
                <span>18h30</span>
              </div>

              <hr />

              <div class="mais-detalhes">
                <span>Vaga ocupada</span>
                <span><?php echo($card['vaga']); ?></span>
              </div>

              <div class="mais-detalhes">
                <span>Tempo Estacionado</span>
                <span>2h 30m</span>
              </div>

              <div class="mais-detalhes">
                <span>Valor estimado</span>
                <span>R$ 25,00</span>
              </div>

              <hr />

              <div class="acoes-card">
                <button id="excluir-veiculo-button">Excluir</button>
                <button id="editar-veiculo-button">Editar</button>
                <button id="dar-baixa-veiculo-button">Dar baixa</button>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </main>
  </body>
  <script src="js/script.js"></script>
</html>
