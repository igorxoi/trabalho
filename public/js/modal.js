const modal = document.querySelector("#modal-dados-veiculo");
const vaga = document.querySelector("#vaga");
const dadosEntrada = document.querySelector("#dados-entrada");
const dadosSaida = document.querySelector("#dados-saida");
const valorPrimeiraHora = document.querySelector("#valor-primeira-hora");
const valorDemaisHoras = document.querySelector("#valor-demais-horas");
const tempoEstacionado = document.querySelector("#tempo-estacionado");
const valorTotal = document.querySelector("#valor-total");
const proprietario = document.querySelector("#proprietario");
const modeloPlaca = document.querySelector("#modelo-e-placa");

function abrirModalDarBaixa(id) {
  fetch("index.php?url=estacionamento/buscarVeiculoPorId", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "id=" + encodeURIComponent(id),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "sucesso") {
        exibirModal(data.dados);

        const botaoDarBaixa = document.getElementById("btn-dar-baixa");
        const novoBotao = botaoDarBaixa.cloneNode(true);
        botaoDarBaixa.parentNode.replaceChild(novoBotao, botaoDarBaixa);

        novoBotao.addEventListener("click", function () {
          darBaixa(id);
        });
      } else {
        alert("Problemas ao exibir os dados.");
      }
    })
    .catch((error) => {
      alert("Erro ao buscar dados do veículo:", error);
    });
}

function exibirModal(veiculo) {
  modal.classList.add("exibirModal");
  popularModal(veiculo);
}

function fecharModal() {
  modal.classList.remove("exibirModal");
}

function popularModal(veiculo) {
  vaga.textContent = veiculo.vaga;
  dadosEntrada.textContent = veiculo.dataEntrada;
  dadosSaida.textContent = veiculo.dataSaida;
  valorPrimeiraHora.textContent = veiculo.valorPrimeiraHora;
  valorDemaisHoras.textContent = veiculo.valorDemaisHoras;
  tempoEstacionado.textContent = veiculo.tempoEstacionadoFormatado;
  valorTotal.textContent = veiculo.valorTotal;
  proprietario.textContent = veiculo.proprietario;
  modeloPlaca.textContent = `${veiculo.modelo} / ${veiculo.placa}`;
}

function formatarParaReal(valor) {
  const numerico = parseFloat(valor);

  return numerico.toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL",
  });
}

function darBaixa(id) {
  fetch("index.php?url=statusVeiculo/darBaixa", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "id=" + encodeURIComponent(id),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "sucesso") {
        fecharModal();
        removerCard(data.dados.estacionamentoId);
        exibirSnackbar();
      } else {
        alert("Problemas ao exibir os dados.");
      }
    })
    .catch((error) => {
      alert("Erro ao buscar dados do veículo:", error);
    });
}

function exibirSnackbar() {
  const snackbar = document.getElementById("snackbar");
  snackbar.className = "show";

  setTimeout(function () {
    snackbar.classList.remove("show");
  }, 2800);
}

function removerCard(id) {
  const div = document.getElementById(`card-${id}`);
  div.remove();
}
