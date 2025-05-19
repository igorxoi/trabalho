const modal = document.querySelector(".modal--container");
const vaga = document.querySelector("#vaga");
const dadosEntrada = document.querySelector("#dados-entrada");
const dadosSaida = document.querySelector("#dados-saida");
const valorPrimeiraHora = document.querySelector("#valor-primeira-hora");
const valorDemaisHoras = document.querySelector("#valor-demais-horas");
const tempoEstacionado = document.querySelector("#tempo-estacionado");
const valorTotal = document.querySelector("#valor-total");
const proprietario = document.querySelector("#proprietario");
const modeloPlaca = document.querySelector("#modelo-e-placa");

function darBaixa(id) {
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
      } else {
        console.warn("Problemas ao exibir os dados.");
      }
    })
    .catch((error) => {
      console.error("Erro ao buscar dados do veículo:", error);
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
  valorPrimeiraHora.textContent = formatarParaReal(veiculo.valorPrimeiraHora);
  valorDemaisHoras.textContent = formatarParaReal(veiculo.valorDemaisHoras);
  tempoEstacionado.textContent = veiculo.tempoEstacionadoFormatado;
  valorTotal.textContent = formatarParaReal(veiculo.valorTotal);
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
