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
  <title>Cadastrar veículo</title>
</head>

<body>
  <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

  <main class="main--container">
    <header class="header--conteudo">
      <div class="header--titulo">
        <h1>Cadastro de Veículo</h1>
        <span class="header--subtitulo"></span>
      </div>
    </header>

    <div class="cadastro-veiculo--container">
      <h2>Tipo do veículo</h2>
      <form
        id="form-veiculo"
        method="POST"
        action="
          <?php echo !isset($veiculo)
            ? "index.php?url=estacionamento/cadastrarVeiculo"
            : "index.php?url=estacionamento/editarVeiculo/$veiculo[id]"; ?>
        ">
        <div class="selecao-tipo-veiculo">
          <div
            class="opcao-tipo-veiculo"
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
          <input
            type="hidden"
            name="tipo"
            id="tipo"
            value="<?php echo isset($veiculo['tipo_vaga_id']) ? $veiculo['tipo_vaga_id'] : '1'; ?>" />
        </div>

        <h2>Informações do veículo</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="text"
              name="placa"
              id="placa"
              maxlength="7"
              value="<?php echo isset($veiculo['placa']) ? $veiculo['placa'] : ''; ?>" />
            <label
              for="placa"
              id="label-placa">
              Placa do veículo
            </label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="modelo"
              id="modelo"
              maxlength="20"
              value="<?php echo isset($veiculo['modelo']) ? $veiculo['modelo'] : ''; ?>" />
            <label
              for="modelo"
              id="label-modelo">
              Modelo
            </label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="marca"
              id="marca"
              maxlength="20"
              value="<?php echo isset($veiculo['marca']) ? $veiculo['marca'] : ''; ?>" />
            <label
              for="marca"
              id="label-marca">
              Marca
            </label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="cor"
              id="cor"
              maxlength="20"
              value="<?php echo isset($veiculo['cor']) ? $veiculo['cor'] : ''; ?>" />
            <label
              for="cor"
              id="label-cor">
              Cor
            </label>
          </div>
        </div>

        <h2>Informações do proprietário</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="text"
              name="nome_proprietario"
              id="nome_proprietario"
              maxlength="30"
              value="<?php echo isset($veiculo['proprietario']) ? $veiculo['proprietario'] : ''; ?>" />
            <label
              for="nome_proprietário"
              id="label-nome_proprietario">
              Nome do proprietário
            </label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="telefone_proprietario"
              id="telefone_proprietario"
              maxlength="20"
              value="<?php echo isset($veiculo['telefone']) ? $veiculo['telefone'] : ''; ?>" />
            <label
              for="telefone_proprietario"
              id="label-telefone_proprietario">
              Telefone do proprietário
            </label>
          </div>
        </div>

        <h2>Informações do estacionamento</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="text"
              name="vaga"
              id="vaga"
              maxlength="5"
              value="<?php echo isset($veiculo['vaga']) ? $veiculo['vaga'] : ''; ?>" />
            <label
              for="vaga"
              id="label-vaga">
              Vaga ocupada
            </label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="data_hora"
              disabled
              id="data_hora" />
            <label
              for="data_hora">
              Data/Hora
            </label>
          </div>
        </div>

        <div class="acoes-cadastrar-veiculo">
          <button class="botao secundario" onclick="navegarPara('dashboard')">Cancelar</button>
          <input type="submit" class="botao primario" value="Cadastrar">
        </div>
      </form>
    </div>
  </main>
</body>

<script src="js/script.js"></script>
<script src="js/validacoes.js"></script>

</html>