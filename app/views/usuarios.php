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
        <h1>Listagem de usuários</h1>
        <span class="header--subtitulo"></span>
      </div>
    </header>
    <div class="table--container">
      <div style="display: flex; padding-bottom: 1.5rem; justify-content: end;">
        <a style="width: auto;" href="index.php?url=usuario/cadastro" class="botao primario">Cadastrar usuário</a>
      </div>
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $item): ?>
            <tr>
              <td><?php echo ($item['id']); ?></td>
              <td><?php echo ($item['nome']); ?></td>
              <td><?php echo ($item['email']); ?></td>
              <td style="display: flex; gap: 8px;">
                <a
                  href="index.php?url=usuario/alterar/<?php echo $item['id']; ?>">
                  <span class="material-symbols-outlined" style="cursor: pointer;">
                    edit
                  </span>
                </a>
                <a
                  href="index.php?url=usuario/deletar/<?php echo $item['id']; ?>">
                  <span class="material-symbols-outlined" style="cursor: pointer;">
                    delete
                  </span>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>
</body>
<script src="js/script.js"></script>

</html>