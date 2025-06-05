import { formularios } from "./validacoesCampos.js";

document.addEventListener("DOMContentLoaded", () => {
  const formId = Object.keys(formularios).find((id) =>
    document.getElementById(id)
  );
  if (!formId) return;

  const form = document.getElementById(formId);
  const campos = formularios[formId];
  const inputs = form.querySelectorAll("input");

  const getInputValue = (id) => {
    const el = document.getElementById(id);
    return el ? el.value.trim() : "";
  };

  const toggleErro = (id, condicao) => {
    const input = document.getElementById(id);
    if (input) input.classList.toggle("input-erro", !condicao);
  };

  const atualizarPreenchido = (input) => {
    input.classList.toggle("preenchido", input.value.trim() !== "");
  };

  const configurarEventosInput = (input) => {
    input.addEventListener("input", () => {
      atualizarPreenchido(input);
      input.classList.remove("input-erro");
    });
    atualizarPreenchido(input);
  };

  inputs.forEach(configurarEventosInput);

  form.addEventListener("submit", (event) => {
    let formularioValido = true;
    const mensagensErro = [];

    campos.forEach(({ id, validacao, mensagem }) => {
      const valor = getInputValue(id);
      const valido = validacao(valor);
      toggleErro(id, valido);
      if (!valido) {
        formularioValido = false;
        mensagensErro.push(mensagem);
      }
    });

    if (formId === "form-cadastro-usuario") {
      const senha = getInputValue("senha");
      const confirmacao = getInputValue("confirmacao_senha");
      if (senha !== confirmacao) {
        formularioValido = false;
        toggleErro("senha", false);
        toggleErro("confirmacao_senha", false);
        mensagensErro.push("As senhas não coincidem.");
      }
    }

    if (formId === "form-editar-usuario") {
      const senha = getInputValue("senha");
      const confirmacao = getInputValue("confirmacao_senha");

      if (senha !== "") {
        if (senha.length < 6) {
          formularioValido = false;
          toggleErro("senha", false);
          mensagensErro.push("A nova senha deve ter pelo menos 6 caracteres.");
        }
        if (senha !== confirmacao) {
          formularioValido = false;
          toggleErro("senha", false);
          toggleErro("confirmacao_senha", false);
          mensagensErro.push(
            "A confirmação de senha não corresponde à nova senha."
          );
        }
      }
    }

    if (!formularioValido) {
      event.preventDefault();
      alert(mensagensErro.join("\n"));
    }
  });
});
