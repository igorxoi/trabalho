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
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dados as $item): ?>
            <tr>
              <td><?php echo ($item['vaga']); ?></td>
              <td><?php echo ($item['proprietario']); ?></td>
              <td><?php echo ($item['modelo']); ?> / <?php echo ($item['placa']); ?></td>
              <td><?php echo ($item['dataEntrada']); ?></td>
              <td><?php echo ($item['horaEntrada']); ?></td>
              <td><?php echo ($item['tempoEstacionadoFormatado']); ?></td>
              <td><?php echo ($item['valorTotal']); ?></td>
              <td>
                <span class="status <?php echo getStatusClass($item['descricao']); ?>">
                  <span class="material-symbols-outlined"><?php echo getStatusIcon($item['descricao']); ?></span>
                  <?php echo ($item['descricao']); ?>
                </span>
              </td>
            </tr>
          <?php endforeach; ?>
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