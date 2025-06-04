<?php require_once(__DIR__ . '/../helpers/utils.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=.sliderbar, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
  <title>Gerenciar Estacionamento</title>
</head>

<body>
  <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

  <main class="main--container">
    <header class="header--conteudo">
      <div class="header--titulo">
        <h1>Gerenciar Estacionamento</h1>
        <span class="header--subtitulo"></span>
      </div>
    </header>
    <div class="card--container">
      <div class="card--conteudo">
        <div class="card">
          <div class="veiculo-info">
            <span class="tipo-veiculo">
              <i class="material-symbols-outlined">two_wheeler</i>
            </span>
            <div class="detalhes-veiculo">
              <span class="status estacionado">
                <span class="material-symbols-outlined">timer</span>
                Estacionado
              </span>
              <span class="nome-condutor">Igor Xavier</span>
              <span class="mais-detalhes">Honda / ADC2021</span>
            </div>
          </div>

          <div class="mais-detalhes">
            <span>Qua, 12 Jul 2025</span>
            <span>18h30</span>
          </div>

          <hr />

          <div class="mais-detalhes">
            <span>Vaga ocupada</span>
            <span>21</span>
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

        <div class="card">
          <div class="veiculo-info">
            <span class="tipo-veiculo">
              <i class="material-symbols-outlined"> directions_car</i>
            </span>
            <div class="detalhes-veiculo">
              <span class="status liberado">
                <span class="material-symbols-outlined">flag</span>
                Pronto para saída
              </span>
              <span class="nome-condutor">Igor Xavier</span>
              <span class="mais-detalhes">Honda / ADC2021</span>
            </div>
          </div>

          <div class="mais-detalhes">
            <span>Qua, 12 Jul 2025</span>
            <span>18h30</span>
          </div>

          <hr />

          <div class="mais-detalhes">
            <span>Vaga ocupada</span>
            <span>21</span>
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

        <div class="card">
          <div class="veiculo-info">
            <span class="tipo-veiculo">
              <i class="material-symbols-outlined">airport_shuttle</i>
            </span>
            <div class="detalhes-veiculo">
              <span class="status baixa">
                <span class="material-symbols-outlined">done_all</span>
                Baixa realizada
              </span>
              <span class="nome-condutor">Igor Xavier</span>
              <span class="mais-detalhes">Honda / ADC2021</span>
            </div>
          </div>

          <div class="mais-detalhes">
            <span>Qua, 12 Jul 2025</span>
            <span>18h30</span>
          </div>

          <hr />

          <div class="mais-detalhes">
            <span>Vaga ocupada</span>
            <span>21</span>
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

        <div class="card">
          <div class="veiculo-info">
            <span class="tipo-veiculo">
              <i class="material-symbols-outlined">local_shipping</i>
            </span>
            <div class="detalhes-veiculo">
              <span class="status baixa">
                <span class="material-symbols-outlined">done_all</span>
                Baixa realizada
              </span>
              <span class="nome-condutor">Igor Xavier</span>
              <span class="mais-detalhes">Honda / ADC2021</span>
            </div>
          </div>

          <div class="mais-detalhes">
            <span>Qua, 12 Jul 2025</span>
            <span>18h30</span>
          </div>

          <hr />

          <div class="mais-detalhes">
            <span>Vaga ocupada</span>
            <span>21</span>
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
      </div>
    </div>
  </main>

</body>
<script src="js/script.js"></script>
</html>