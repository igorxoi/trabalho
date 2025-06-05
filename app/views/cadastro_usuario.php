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
  <title>Cadastrar usuários</title>
</head>

<body>
  <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

  <main class="main--container">
    <header class="header--conteudo">
      <div class="header--titulo">
        <h1>Cadastro de Usuários</h1>
        <span class="header--subtitulo"></span>
      </div>
    </header>

    <div class="cadastro-veiculo--container">
      <form action="">
        <h2>Dados do usuário</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input type="text" name="nome" required id="nome" />
            <label for="nome">Nome</label>
          </div>
          <div class="input-formulario">
            <input type="text" name="email" required id="email" />
            <label for="email">E-mail</label>
          </div>
          <div class="input-formulario">
            <input type="text" name="senha" required id="senha" />
            <label for="senha">Senha</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="confirmacao_senha"
              required
              id="confirmacao_senha" />
            <label for="confirmacao_senha">Confirmação de senha</label>
          </div>
        </div>

        <h2>Permissões</h2>

        <div class="grupo-input">
          <div class="checkbox-formulario">
            <input type="checkbox" />
            <label style="font-size: 14px">Dashboard</label>
          </div>

          <div class="checkbox-formulario">
            <input type="checkbox" />
            <label style="font-size: 14px">Cadastro de veículo</label>
          </div>

          <div class="checkbox-formulario">
            <input type="checkbox" />
            <label style="font-size: 14px">Gerenciar estacionamento</label>
          </div>

          <div class="checkbox-formulario">
            <input type="checkbox" />
            <label style="font-size: 14px">Histórico</label>
          </div>

          <div class="checkbox-formulario">
            <input type="checkbox" />
            <label style="font-size: 14px">Cadastrar usuários</label>
          </div>

          <div class="checkbox-formulario">
            <input type="checkbox" />
            <label style="font-size: 14px">Configurações</label>
          </div>
        </div>

        <div class="acoes-cadastrar-veiculo">
          <button onclick="navegarPara('dashboard')">Cancelar</button>
          <input type="submit" class="botao primario" value="Cadastrar">
        </div>
      </form>
    </div>
  </main>
</body>
<script src="js/script.js"></script>

</html>