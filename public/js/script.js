// VARIÁVEIS GLOBAIS
const sidebar = document.querySelector(".sidebar");
const menuItem = document.querySelectorAll(".menu li span");
const iconeMenu = document.querySelector(".icon-menu");
const cardsTipo = document.querySelectorAll(".opcao-tipo-veiculo");

const inputQntVagas = document.querySelector("#qnt_vagas");
const inputValorPrimeiraHora = document.querySelector("#valor_primeira_hora");
const inputValorDemaisHoras = document.querySelector("#valor_demais_horas");
const tipoVeiculo = document.querySelector("#tipo")?.value;
const inputPlaca = document.querySelector("#placa");
const inputTelefone = document.querySelector("#telefone_proprietario");

// FUNÇÕES
function obterData(abreviado) {
  let horaFormatada = "";
  const data = new Date();

  const opcoesExtenso = {
    weekday: "long",
    day: "numeric",
    month: "long",
    year: "numeric",
  };

  const opcoesAbreviado = {
    weekday: "short",
    day: "numeric",
    month: "short",
    year: "numeric",
  };

  let dataFormatada = data.toLocaleDateString(
    "pt-BR",
    abreviado ? opcoesAbreviado : opcoesExtenso
  );

  if (abreviado) {
    dataFormatada = dataFormatada.replace(/\./g, "").replace(/\sde\s/g, " ");
    horaFormatada = data.toLocaleTimeString("pt-BR", {
      hour: "2-digit",
      minute: "2-digit",
      hour12: false,
    });
  }

  return `${dataFormatada} ${horaFormatada}`;
}

function definirDisplay(elements, displayStyle) {
  const nomeLogo = document.querySelector(".nome-estaciona-aqui");
  nomeLogo.style.display = displayStyle;

  elements.forEach((item) => {
    item.style.display = displayStyle;
  });
}

function expandirMenu() {
  const expandido = sidebar.classList.contains("sidebar--ativo");

  sidebar.classList.toggle("sidebar--ativo");
  iconeMenu.textContent = expandido ? "arrow_menu_open" : "arrow_menu_close";

  definirDisplay(menuItem, expandido ? "none" : "block");
}

function selecionarTipoVeiculo(idTipo) {
  const tipoVeiculoMap = {
    1: "#veiculo-moto",
    2: "#veiculo-carro-pequeno",
    3: "#veiculo-carro-grande",
    4: "#veiculo-caminhao",
  };

  const seletor = tipoVeiculoMap[idTipo];
  const cardSelecionado = document.querySelector(seletor);

  if (cardSelecionado) {
    definirCardAtivo(cardSelecionado, idTipo);
  }
}

function definirCardAtivo(cardAtivo, idTipo) {
  cardsTipo.forEach((card) => card.classList.remove("ativo"));
  document.querySelector("#tipo").value = idTipo;
  cardAtivo.classList.add("ativo");
}

function navegarPara(tela) {
  const navegacao = {
    dashboard: "index.php?url=estacionamento/dashboard",
    gerenciar: "index.php?url=estacionamento/gerenciar",
    cadastroVeiculo: "index.php?url=veiculo/cadastro",
    configuracoes: "index.php?url=estacionamento/configuracoes",
    historico: "index.php?url=estacionamento/historico",
    listagemUsuarios: "index.php?url=usuario/listar"
  };

  window.location = navegacao[tela];
}

function aplicarMascaraMoeda(campo) {
  let valor = campo.value.replace(/\D/g, "");

  if (valor.length === 0) {
    campo.value = "R$ 0,00";
    return;
  }

  valor = (parseFloat(valor) / 100).toFixed(2);

  campo.value = Number(valor).toLocaleString("pt-BR", {
    style: "currency",
    currency: "BRL",
  });
}

function aplicarMascaraPlaca(input) {
  input.addEventListener("input", () => {
    let valor = input.value.toUpperCase().replace(/[^A-Z0-9]/g, "");

    if (valor.length > 7) valor = valor.slice(0, 7);

    // Aplica o padrão: 3 letras, 1 número, 1 letra ou número, 2 números
    const placaFormatada = valor
      .replace(/^([A-Z]{0,3})/, "$1")
      .replace(/^([A-Z]{3})([0-9]{0,1})/, "$1$2")
      .replace(/^([A-Z]{3}[0-9]{1})([A-Z0-9]{0,1})/, "$1$2")
      .replace(/^([A-Z]{3}[0-9]{1}[A-Z0-9]{1})([0-9]{0,2}).*/, "$1$2");

    input.value = placaFormatada;
  });
}

function aplicarMascaraTelefone(input) {
  input.addEventListener("input", () => {
    let valor = input.value.replace(/\D/g, "").slice(0, 11);

    if (valor.length >= 2) {
      valor = `(${valor.slice(0, 2)}) ${valor.slice(2)}`;
    }

    if (valor.length >= 7) {
      valor = valor.replace(/(\(\d{2}\))\s?(\d{5})(\d{0,4})/, "$1 $2-$3");
    }

    input.value = valor.trim();
  });
}

// EVENTOS E EXECUÇÕES INICIAIS
window.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".moeda").forEach((input) => {
    input.value = "R$ 0,00";
    input.classList.add("preenchido");
  });

  document.querySelector(".header--subtitulo").textContent = obterData(false);
  document.querySelector("#data_hora").value = obterData(true);

  aplicarMascaraPlaca(inputPlaca);
  aplicarMascaraTelefone(inputTelefone);
  selecionarTipoVeiculo(tipoVeiculo);
});
