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
          <div class="card" id="card-<?php echo $card['id']; ?>">
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
              <span><?php echo ($card['tempoEstacionadoFormatado']); ?></span>
            </div>

            <div class="mais-detalhes">
              <span>Valor estimado</span>
              <span><?php echo ($card['valorTotal']); ?></span>
            </div>

            <hr />

            <div class="acoes-card">
              <?php if (in_array($card['status_id'], [1, 4])): ?>
                <a id="dar-baixa-veiculo-button" class="botao primario">Ver detalhes</a>
              <?php else: ?>

                <?php if ($card['status_id'] == 2): ?>
                  <a
                    href="index.php?url=statusVeiculo/cancelar/<?php echo $card['id']; ?>"
                    class="botao secundario">
                    Cancelar
                  </a>
                <?php endif; ?>

                <a
                  href="index.php?url=cadastro/index/<?php echo $card['id']; ?>"
                  class="botao secundario">
                  Editar
                </a>

                <?php if ($card['status_id'] == 2): ?>
                  <a
                    href="index.php?url=statusVeiculo/liberar/<?php echo $card['id']; ?>"
                    class="botao primario">
                    Liberar
                  </a>
                <?php else:  ?>
                  <button class="botao primario" onclick="abrirModalDarBaixa(<?php echo $card['id']; ?>)">Dar baixa</button>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </main>

  <div class="modal--container" id="modal-dados-veiculo">
    <div class="modal">
      <div class="veiculo-info">
        <span class="tipo-veiculo">
          <i class="material-symbols-outlined"><?php echo getVehicleTypeIcon($card['tipo']); ?></i>
        </span>
        <div class="detalhes-veiculo">
          <span class="nome-condutor" id="proprietario"><?php echo ($card['proprietario']); ?></span>
          <span class="mais-detalhes" id="modelo-e-placa"><?php echo ($card['modelo'] . ' / ' . $card['placa']); ?></span>
        </div>
      </div>

      <div class="mais-detalhes">
        <span>Vaga ocupada</span>
        <span id="vaga"><?php echo ($card['vaga']); ?></span>
      </div>

      <div class="mais-detalhes">
        <span>Entrada</span>
        <span id="dados-entrada"></span>
      </div>

      <div class="mais-detalhes">
        <span>Saída</span>
        <span id="dados-saida"></span>
      </div>
      <hr>

      <div class="mais-detalhes">
        <span>Valor primeira hora</span>
        <span id="valor-primeira-hora"></span>
      </div>

      <div class="mais-detalhes">
        <span>Valor demais</span>
        <span id="valor-demais-horas"></span>
      </div>

      <hr>
      <div class="mais-detalhes">
        <span>Tempo estacionado</span>
        <span id="tempo-estacionado"></span>
      </div>

      <div class="mais-detalhes">
        <span>Valor total:</span>
        <span id="valor-total"></span>
      </div>
      <hr>

      <div class="acoes-card">
        <button class="botao secundario" onclick="fecharModal()">Cancelar</button>
        <button class="botao primario" id="btn-dar-baixa">Dar baixa</button>
      </div>
    </div>
  </div>

  <div id="snackbar">
    <div>
      <span>Sucesso</span>
      Saída registrada com sucesso. O veículo teve sua baixa realizada.
    </div>
  </div>
</body>
<script src="js/script.js"></script>
<script src="js/modal.js"></script>

</html>