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
  <title>Histórico</title>
</head>

<body>
  <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

  <main class="main--container">
      <header class="header--conteudo">
        <div class="header--titulo">
          <h1>Histórico</h1>
          <span class="header--subtitulo"></span>
        </div>
      </header>
      <div class="table--container">
        <table>
          <thead>
            <tr>
              <th>Vaga</th>
              <th>Condutor</th>
              <th>Veículo</th>
              <th>Data</th>
              <th>Hora</th>
              <th>Tempo Estacionado</th>
              <th>Valor Estimado</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>A3</td>
              <td>Igor Xavier</td>
              <td>Honda / ADC2021</td>
              <td>12 Jul 2025</td>
              <td>18h30</td>
              <td>2h 30m</td>
              <td>R$ 25,00</td>
              <td>
                <span class="status estacionado">
                  <span class="material-symbols-outlined">timer</span>
                  Estacionado
                </span>
              </td>
              <td>
                <!-- <button class="detalhes">Ver Detalhes</button>
                  <button class="baixa">Dar baixa</button> -->
              </td>
            </tr>
            <tr>
              <td>A3</td>
              <td>Igor Xavier</td>
              <td>Honda / ADC2021</td>
              <td>12 Jul 2025</td>
              <td>18h30</td>
              <td>2h 30m</td>
              <td>R$ 25,00</td>
              <td>
                <span class="status liberado">
                  <span class="material-symbols-outlined">flag</span>

                  Pronto para saída
                </span>
              </td>
              <td>
                <!-- <button class="detalhes">Ver Detalhes</button>
                  <button class="baixa">Dar baixa</button> -->
              </td>
            </tr>
            <tr>
              <td>A3</td>
              <td>Igor Xavier</td>
              <td>Honda / ADC2021</td>
              <td>12 Jul 2025</td>
              <td>18h30</td>
              <td>2h 30m</td>
              <td>R$ 25,00</td>
              <td>
                <span class="status baixa">
                  <span class="material-symbols-outlined">done_all</span>
                  Baixa realizada
                </span>
              </td>
              <td>
                <!-- <button class="detalhes">Ver Detalhes</button> -->
              </td>
            </tr>
          </tbody>
        </table>

        <!-- <div class="pagination--content">
            <div class="pagination">
              <button onclick="paginaAnterior()">Anterior</button>
              <span class="page-info ativo">1</span>
              <span class="page-info">2</span>
              <span class="page-info">3</span>
              <span class="page-info">4</span>
              <button onclick="proximaPagina()">Próximo</button>
            </div>
          </div> -->
      </div>
    </main>
</body>
<script src="js/script.js"></script>

</html>