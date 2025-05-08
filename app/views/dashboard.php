<?php require_once(__DIR__ . '/../helpers/utils.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=.sliderbar, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    />
    <title>Dashboard</title>
  </head>
  <body>
    <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

    <main class="main--container">
      <header class="header--conteudo">
        <div class="header--titulo">
          <h1>Resumo do estacionamento</h1>
          <span class="header--subtitulo"></span>
        </div>
      </header>
      <div class="dashboard--container">
        <div class="card--conteudo">
          <div class="card">
            <div class="item-dashbord">
              <span class="icone">
                <i class="material-symbols-outlined">garage</i>
              </span>
              <div class="detalhes">
                <h2>42</h2>
                <span class="descricao">Vagas disponíveis</span>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="item-dashbord">
              <span class="icone">
                <i class="material-symbols-outlined">car_lock</i>
              </span>
              <div class="detalhes">
                <h2>42</h2>
                <span class="descricao">Carros estacionados</span>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="item-dashbord">
              <span class="icone">
                <i class="material-symbols-outlined">money_bag</i>
              </span>
              <div class="detalhes">
                <h2>R$ 450,00</h2>
                <span class="descricao">Receita do dia</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
  <script src="js/script.js"></script>
</html>