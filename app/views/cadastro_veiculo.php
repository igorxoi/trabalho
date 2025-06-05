<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=.sliderbar, initial-scale=1.0" />
  <link rel="stylesheet" href="css/style.css" />
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
      <form action="">
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

        <h2>Informações do veículo</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input type="text" name="placa" required id="placa" />
            <label for="placa">Placa do veículo</label>
          </div>
          <div class="input-formulario">
            <input type="text" name="modelo" required id="modelo" />
            <label for="modelo">Modelo</label>
          </div>
          <div class="input-formulario">
            <input type="text" name="marca" required id="marca" />
            <label for="marca">Marca</label>
          </div>
          <div class="input-formulario">
            <input type="text" name="cor" required id="cor" />
            <label for="cor">Cor</label>
          </div>
        </div>

        <h2>Informações do proprietário</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="text"
              name="nome_proprietario"
              required
              id="nome_proprietario" />
            <label for="nome_proprietário">Nome do proprietário</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="telefone_proprietario"
              required
              id="telefone_proprietario" />
            <label for="telefone_proprietario">
              Telefone do proprietário
            </label>
          </div>
        </div>

        <h2>Informações do estacionamento</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input type="text" name="vaga" required id="vaga" />
            <label for="vaga">Vaga ocupada</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="data_hora"
              disabled
              required
              id="data_hora" />
            <label for="data_hora">Data/Hora</label>
          </div>
        </div>

        <div class="acoes-cadastrar-veiculo">
          <button onclick="navegarPara('dashboard')">Cancelar</button>
          <input type="submit" value="Cadastrar">
        </div>
      </form>
    </div>
  </main>
</body>
<script src="js/script.js"></script>

</html>