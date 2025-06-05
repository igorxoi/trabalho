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
        <h1><?php echo !isset($usuario) ? "Alterar" : "Cadastro"; ?></h1>
        <span class="header--subtitulo"></span>
      </div>
    </header>

    <div class="cadastro-veiculo--container">
      <form
        method="POST"
        id="<?php echo !isset($usuario) ? "form-cadastro-usuario" : "form-editar-usuario"; ?>"
        action="<?php echo !isset($usuario) ? "index.php?url=usuario/salvar" : "index.php?url=usuario/editar/$usuario[id]"; ?>">
        <h2>Dados do usuário</h2>

        <div class="grupo-input">
          <div class="input-formulario">
            <input
              type="text"
              name="nome"
              id="nome"
              value="<?php echo isset($usuario['nome']) ? $usuario['nome'] : ''; ?>" />
            <label for="nome">Nome</label>
          </div>
          <div class="input-formulario">
            <input
              type="text"
              name="email"
              id="email"
              value="<?php echo isset($usuario['email']) ? $usuario['email'] : ''; ?>" />
            <label for="email">E-mail</label>
          </div>
          <div class="input-formulario">
            <input
              type="password"
              name="senha"
              id="senha" />
            <label for="senha">Senha</label>
          </div>
          <div class="input-formulario">
            <input
              type="password"
              name="confirmacao_senha"
              id="confirmacao_senha" />
            <label for="confirmacao_senha">Confirmação de senha</label>
          </div>
        </div>

        <h2>Permissões</h2>

        <div class="grupo-input">
          <div class="checkbox-formulario">
            <input
              type="checkbox"
              name="checkbox_dashboard"
              <?php echo isset($usuario['permissoes']['dashboard']) && $usuario['permissoes']['dashboard'] ? 'checked' : ''; ?> />
            <label style="font-size: 14px">Dashboard</label>
          </div>

          <div class="checkbox-formulario">
            <input
              type="checkbox"
              name="checkbox_cadastro_veiculo"
              <?php echo isset($usuario['permissoes']['cadastro_veiculo']) && $usuario['permissoes']['cadastro_veiculo'] ? 'checked' : ''; ?> />
            <label style="font-size: 14px">Cadastro de veículo</label>
          </div>

          <div class="checkbox-formulario">
            <input
              type="checkbox"
              name="checkbox_gerenciar_estacionamento"
              <?php echo isset($usuario['permissoes']['gerenciamento']) && $usuario['permissoes']['gerenciamento'] ? 'checked' : ''; ?> />
            <label style="font-size: 14px">Gerenciar estacionamento</label>
          </div>

          <div class="checkbox-formulario">
            <input
              type="checkbox"
              name="checkbox_historico"
              <?php echo isset($usuario['permissoes']['historico']) && $usuario['permissoes']['historico'] ? 'checked' : ''; ?> />
            <label style="font-size: 14px">Histórico</label>
          </div>

          <div class="checkbox-formulario">
            <input
              type="checkbox"
              name="checkbox_cadastrar_usuario"
              <?php echo isset($usuario['permissoes']['cadastro_usuario']) && $usuario['permissoes']['cadastro_usuario'] ? 'checked' : ''; ?> />
            <label style="font-size: 14px">Cadastrar usuários</label>
          </div>

          <div class="checkbox-formulario">
            <input
              type="checkbox"
              name="checkbox_configuracoes"
              <?php echo isset($usuario['permissoes']['configuracoes']) && $usuario['permissoes']['configuracoes'] ? 'checked' : ''; ?> />
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
<script type="module" src="js/validacoes.js"></script>

</html>