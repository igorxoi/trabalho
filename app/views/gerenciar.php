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
  <title>Gerenciar Estacionamento</title>
</head>

<body>
  <?php require_once __DIR__ . '/../components/sidebar.php'; ?>

  <main class="main--container">
    <header class="header--conteudo">
      <div class="header--titulo">
        <h1>Gerenciar Estacionamento</h1>
        <span class="header--subtitulo"></span>
      </div>
    </header>
    <div class="card--container">
      <div class="card--conteudo">

        <?php foreach ($cards as $card): ?>
          <div class="card">
            <div class="veiculo-info">
              <span class="tipo-veiculo">
                <i class="material-symbols-outlined"><?php echo getVehicleTypeIcon($card['tipo']); ?></i>
              </span>
              <div class="detalhes-veiculo">
                <span class="status <?php echo getStatusClass($card['descricao']); ?>">
                  <span class="material-symbols-outlined"><?php echo getStatusIcon($card['descricao']); ?></span>
                  <?php echo ($card['descricao']); ?>
                </span>
                <span class="nome-condutor"><?php echo ($card['proprietario']); ?></span>
                <span class="mais-detalhes"><?php echo ($card['modelo'] . ' / ' . $card['placa']); ?></span>
              </div>
            </div>

            <div class="mais-detalhes">
              <span><?php echo ($card['status_data_formatada']); ?></span>
              <span><?php echo ($card['status_hora_formatada']); ?></span>
            </div>

            <hr />

            <div class="mais-detalhes">
              <span>Vaga ocupada</span>
              <span><?php echo ($card['vaga']); ?></span>
            </div>

            <div class="mais-detalhes">
              <span>Tempo Estacionado</span>
              <span>2h 30m</span>
            </div>

            <div class="mais-detalhes">
              <span>Valor estimado</span>
              <span>R$ 25,00</span>
            </div>

            <hr />

            <div class="acoes-card">
              <?php if (in_array($card['status_id'], [1, 4])): ?>
                <a id="dar-baixa-veiculo-button">Ver detalhes</a>
              <?php else: ?>

                <?php if ($card['status_id'] == 2): ?>
                  <a
                    href="index.php?url=statusVeiculo/cancelar/<?php echo $card['id']; ?>"
                    id="excluir-veiculo-button">
                    Cancelar
                  </a>
                <?php endif; ?>

                <a
                  href="index.php?url=cadastro/index/<?php echo $card['id']; ?>"
                  id="editar-veiculo-button">
                  Editar
                </a>

                <?php
                  $acaoUrl = $card['status_id'] == 2
                    ? "index.php?url=statusVeiculo/liberar/{$card['id']}"
                    : "index.php?url=statusVeiculo/darBaixa/{$card['id']}";

                  $acaoTexto = $card['status_id'] == 2 ? "Liberar" : "Dar baixa";
                ?>
                <a href="<?php echo $acaoUrl; ?>" id="dar-baixa-veiculo-button">
                  <?php echo $acaoTexto; ?>
                </a>

              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </main>
</body>
<script src="js/script.js"></script>

</html>