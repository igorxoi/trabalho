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

        <form action="">
          <h4>Moto</h4>

          <div class="grupo-input">
            <div class="input-formulario">
              <input
                type="number"
                name="qnt_vagas_moto"
                required
                id="qnt_vagas_moto"
              />
              <label for="qnt_vagas_moto">Quantidade de vagas</label>
            </div>
            <div class="input-formulario">
              <input type="text" name="valor_moto" required id="valor_moto" />
              <label for="valor_moto">Valor por hora</label>
            </div>
          </div>

          <h4>Carros</h4>

          <div class="grupo-input">
            <div class="input-formulario">
              <input
                type="number"
                name="qnt_vagas_carro"
                required
                id="qnt_vagas_carro"
              />
              <label for="qnt_vagas_carro">Quantidade de vagas</label>
            </div>
            <div class="input-formulario">
              <input type="text" name="valor_carro" required id="valor_carro" />
              <label for="valor_carro">Valor por hora</label>
            </div>
          </div>

          <h4>Carros grandes</h4>

          <div class="grupo-input">
            <div class="input-formulario">
              <input
                type="number"
                name="qnt_vagas_carro_grande"
                required
                id="qnt_vagas_carro_grande"
              />
              <label for="qnt_vagas_carro_grande">Quantidade de vagas</label>
            </div>
            <div class="input-formulario">
              <input
                type="text"
                name="valor_carro_grade"
                required
                id="valor_carro_grade"
              />
              <label for="valor_carro_grade">Valor por hora</label>
            </div>
          </div>

          <h4>Caminhões</h4>

          <div class="grupo-input">
            <div class="input-formulario">
              <input
                type="number"
                name="qnt_vagas_caminhoes"
                required
                id="qnt_vagas_caminhoes"
              />
              <label for="qnt_vagas_caminhoes">Quantidade de vagas</label>
            </div>
            <div class="input-formulario">
              <input
                type="text"
                name="valor_caminhao"
                required
                id="valor_caminhao"
              />
              <label for="valor_caminhao">Valor por hora</label>
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
