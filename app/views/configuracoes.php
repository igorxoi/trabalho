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
      <h2>Quantidade de vagas e preço</h2>

      <form method="POST" action="index.php?url=configuracoes/gerenciarVagas">
        <h4>Moto</h4>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="number"
              name="qnt_vagas_moto"
              required
              id="qnt_vagas_moto" />
            <label for="qnt_vagas_moto">Quantidade de vagas</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_primeira_hora_moto"
              required
              class="moeda"
              id="valor_primeira_hora_moto"
              oninput="mascaraMoeda(this)" />
            <label for="valor_primeira_hora_moto">Valor primeira hora</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_demais_horas_moto"
              required
              class="moeda"
              id="valor_demais_horas_moto"
              oninput="mascaraMoeda(this)" />
            <label for="valor_demais_horas_moto">Valor demais horas</label>
          </div>
        </div>

        <h4>Carros</h4>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="number"
              name="qnt_vagas_carro"
              required
              id="qnt_vagas_carro" />
            <label for="qnt_vagas_carro">Quantidade de vagas</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_primeira_hora_carro"
              required
              class="moeda"
              id="valor_primeira_hora_carro"
              oninput="mascaraMoeda(this)" />
            <label for="valor_primeira_hora_carro">Valor primeira hora</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_demais_horas_carro"
              required
              class="moeda"
              id="valor_demais_horas_carro"
              oninput="mascaraMoeda(this)" />
            <label for="valor_demais_horas_carro">Valor demais horas</label>
          </div>
        </div>

        <h4>Carros grandes</h4>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="number"
              name="qnt_vagas_carro_grande"
              required
              class="moeda"
              id="qnt_vagas_carro_grande" />
            <label for="qnt_vagas_carro_grande">Quantidade de vagas</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_primeira_hora_carro_grande"
              required
              class="moeda"
              id="valor_primeira_hora_carro_grande"
              oninput="mascaraMoeda(this)" />
            <label for="valor_primeira_hora_carro_grande">Valor primeira hora</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_demais_horas_carro_grande"
              required
              class="moeda"
              id="valor_demais_horas_carro_grande"
              oninput="mascaraMoeda(this)" />
            <label for="valor_demais_horas_carro_grande">Valor demais horas</label>
          </div>
        </div>

        <h4>Caminhões</h4>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="number"
              name="qnt_vagas_caminhoes"
              required
              id="qnt_vagas_caminhoes" />
            <label for="qnt_vagas_caminhoes">Quantidade de vagas</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_primeira_hora_caminhoes"
              required
              class="moeda"
              id="valor_primeira_hora_caminhoes"
              oninput="mascaraMoeda(this)" />
            <label for="valor_primeira_hora_caminhoes">Valor primeira hora</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="valor_demais_horas_caminhoes"
              required
              class="moeda"
              id="valor_demais_horas_caminhoes"
              oninput="mascaraMoeda(this)" />
            <label for="valor_demais_horas_caminhoes">Valor demais horas</label>
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