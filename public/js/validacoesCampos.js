export const formularios = {
  "form-veiculo": [
    {
      id: "placa",
      validacao: (val) => val.length >= 7,
      mensagem: "A placa deve ter pelo menos 7 caracteres.",
    },
    {
      id: "modelo",
      validacao: (val) => val !== "",
      mensagem: "O modelo é obrigatório.",
    },
    {
      id: "marca",
      validacao: (val) => val !== "",
      mensagem: "A marca é obrigatória.",
    },
    {
      id: "cor",
      validacao: (val) => val !== "",
      mensagem: "A cor é obrigatória.",
    },
    {
      id: "nome_proprietario",
      validacao: (val) => val !== "",
      mensagem: "O nome do proprietário é obrigatório.",
    },
    {
      id: "telefone_proprietario",
      validacao: (val) => val.length >= 15,
      mensagem: "O telefone do proprietário está incompleto.",
    },
    {
      id: "vaga",
      validacao: (val) => val !== "",
      mensagem: "A vaga é obrigatória.",
    },
  ],
  "form-configuracoes": [
    {
      id: "qnt_vagas",
      validacao: (val) => val !== "",
      mensagem: "A quantidade de vagas é obrigatória.",
    },
    {
      id: "valor_primeira_hora",
      validacao: (val) => val !== "R$ 0,00",
      mensagem: "Informe o valor da primeira hora.",
    },
    {
      id: "valor_demais_horas",
      validacao: (val) => val !== "R$ 0,00",
      mensagem: "Informe o valor das demais horas.",
    },
  ],
  "form-login": [
    {
      id: "email",
      validacao: (val) => val.length >= 10,
      mensagem: "O e-mail deve ter pelo menos 10 caracteres.",
    },
    {
      id: "senha",
      validacao: (val) => val !== "",
      mensagem: "A senha é obrigatória.",
    },
  ],
  "form-cadastro-usuario": [
    {
      id: "nome",
      validacao: (val) => val.length >= 10,
      mensagem: "O nome deve ter pelo menos 10 caracteres.",
    },
    {
      id: "email",
      validacao: (val) => val.length >= 10,
      mensagem: "O e-mail deve ter pelo menos 10 caracteres.",
    },
    {
      id: "senha",
      validacao: (val) => val !== "",
      mensagem: "A senha é obrigatória.",
    },
    {
      id: "confirmacao_senha",
      validacao: (val) => val !== "",
      mensagem: "A confirmação de senha é obrigatória.",
    },
  ],
  "form-editar-usuario": [
    {
      id: "nome",
      validacao: (val) => val.length >= 10,
      mensagem: "O nome deve ter pelo menos 10 caracteres.",
    },
    {
      id: "email",
      validacao: (val) => val.length >= 10,
      mensagem: "O e-mail deve ter pelo menos 10 caracteres.",
    },
  ],
};
