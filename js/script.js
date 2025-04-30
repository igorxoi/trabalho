function obterData(abreviado) {
  const data = new Date();
  let horaFormatada = "";
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

  return (resultado = `${dataFormatada} ${horaFormatada}`);
}

const sidebar = document.querySelector(".sidebar");
const menuItem = document.querySelectorAll(".menu li span");
const iconeMenu = document.querySelector(".icon-menu");

function definirDisplay(elements, displayStyle) {
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

const dataExtenso = obterData(false);
const dataAbreviada = obterData(true);

document.querySelector(".header--subtitulo").textContent = dataExtenso;
document.querySelector("#data_hora").value = dataAbreviada;

const cardsTipo = document.querySelectorAll(".opcao-tipo-veiculo");

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
    dashboard: "index.html",
    gerenciar: "gerenciar.html",
    cadastro: "cadastro.html",
    configuracoes: "configuracoes.html",
    historico: "historico.html"
  };

  window.location = navegacao[tela];
}
