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

  const resultado = `${dataFormatada} ${horaFormatada}`;

  document.querySelector(".header--subtitulo").textContent = resultado;
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
  const expandido = sidebar.classList.contains("sidebar--active");

  sidebar.classList.toggle("sidebar--active");
  iconeMenu.textContent = expandido ? "arrow_menu_open" : "arrow_menu_close";

  definirDisplay(menuItem, expandido ? "none" : "block");
}

obterData(false);
