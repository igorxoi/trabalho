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
  <title>Configurações</title>
</head>

<body>
  <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

  <main class="main--container">
    <header class="header--conteudo">
      <div class="header--titulo">
        <h1>Configurações</h1>
        <span class="header--subtitulo"></span>
      </div>
    </header>
    <div class="configuracoes--container">
      <h2>Tipo do veículo</h2>

      <form method="POST" action="index.php?url=configuracoes/gerenciarVagas">
        <div class="selecao-tipo-veiculo">
          <div
            class="opcao-tipo-veiculo ativo"
            id="veiculo-moto"
            onclick="selecionarTipoVeiculo(1)">
            <i class="material-symbols-outlined">two_wheeler</i>
            <span>Moto</span>
          </div>
          <div
            class="opcao-tipo-veiculo"
            id="veiculo-carro-pequeno"
            onclick="selecionarTipoVeiculo(2)">
            <i class="material-symbols-outlined">directions_car</i>
            <span>Carro pequeno</span>
          </div>
          <div
            class="opcao-tipo-veiculo"
            id="veiculo-carro-grande"
            onclick="selecionarTipoVeiculo(3)">
            <i class="material-symbols-outlined">airport_shuttle</i>
            <span>Carro grande</span>
          </div>
          <div
            class="opcao-tipo-veiculo"
            id="veiculo-caminhao"
            onclick="selecionarTipoVeiculo(4)">
            <i class="material-symbols-outlined">local_shipping</i>
            <span>Caminhão</span>
          </div>
          <input type="hidden" name="tipo" required id="tipo" value="1" />
        </div>

        <h2>Quantidade de vagas e preço</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="number"
              name="qnt_vagas"
              required
              id="qnt_vagas" />
            <label for="qnt_vagas">Quantidade de vagas</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_primeira_hora"
              required
              class="moeda"
              id="valor_primeira_hora"
              oninput="mascaraMoeda(this)" />
            <label for="valor_primeira_hora">Valor primeira hora</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_demais_horas"
              required
              class="moeda"
              id="valor_demais_horas"
              oninput="mascaraMoeda(this)" />
            <label for="valor_demais_horas">Valor demais horas</label>
          </div>
        </div>

        <div class="acoes-cadastrar-veiculo">
          <button onclick="navegarPara('dashboard')">Cancelar</button>
          <input type="submit" value="Salvar" />
        </div>
      </form>
    </div>
  </main>
</body>
<script src="js/script.js"></script>

</html>