document.addEventListener("DOMContentLoaded", () => {  
  const formVeiculo = document.getElementById("form-veiculo");
  const formConfiguracoes = document.getElementById("form-configuracoes");
  const formLogin = document.getElementById("form-login");

  let form;
  let campos;

  if (formVeiculo) {
    form = formVeiculo;
    campos = [
      { id: "placa", validacao: (val) => val.length >= 7 },
      { id: "modelo", validacao: (val) => val !== "" },
      { id: "marca", validacao: (val) => val !== "" },
      { id: "cor", validacao: (val) => val !== "" },
      { id: "nome_proprietario", validacao: (val) => val !== "" },
      { id: "telefone_proprietario", validacao: (val) => val.length >= 15 },
      { id: "vaga", validacao: (val) => val !== "" },
    ];
  } else if (formConfiguracoes) {
    form = formConfiguracoes;
    campos = [
      { id: "qnt_vagas", validacao: (val) => val !== "" },
      { id: "valor_primeira_hora", validacao: (val) => val !== "R$ 0,00" },
      { id: "valor_demais_horas", validacao: (val) => val !== "R$ 0,00" },
    ];
  } else if (formLogin) {
    form = formLogin;
    campos = [
      { id: "email", validacao: (val) => val.length >= 10 },
      { id: "senha", validacao: (val) => val !== "" },
    ];
  }

  if (!form) return;

  const inputs = form.querySelectorAll("input");

  function atualizarPreenchido(input) {
    input.classList.toggle("preenchido", input.value.trim() !== "");
  }

  function configurarEventosInput(input) {    
    input.addEventListener("input", () => {
      atualizarPreenchido(input);
      input.classList.remove("input-erro");
    });
    atualizarPreenchido(input);
  }

  function toggleErro(id, condicao) {
    const input = document.getElementById(id);
    if (input) input.classList.toggle("input-erro", !condicao);
  }

  function getInputValue(id) {
    const el = document.getElementById(id);
    return el ? el.value.trim() : "";
  }

  inputs.forEach(configurarEventosInput);

  form.addEventListener("submit", (event) => {
    let formularioValido = true;
    console.log(formularioValido);
    
    campos.forEach(({ id, validacao }) => {
      const valor = getInputValue(id);
      const valido = validacao(valor);
      toggleErro(id, valido);
      if (!valido) formularioValido = false;
    });

    if (!formularioValido) {
      event.preventDefault();
    }
  });
});
