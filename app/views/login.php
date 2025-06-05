<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<title>Login - EstacioneAqui</title>
	<link rel="icon" type="image/x-icon" href="./assets/logo.png">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-login">
	<section class="fundo-principal">
		<div class="fundo-azul"></div>
		<div class="conteudo-login">
			<div class="caixa-texto">
				<div>
					<img src="./assets/logo.png" class="logo-img" alt="Logo" />
					<h4>Bem-vindo ao</h4>
				</div>
				<h1>EstacioneAqui</h1>
				<p>
					Entre e descubra como é simples administrar seu estacionamento. Acompanhe entradas e saídas, calcule tarifas automaticamente e mantenha tudo sob controle com apenas alguns cliques.
				</p>
				<form action="index.php?url=login/autenticacao" id="form-login" method="POST">
					<div class="input-formulario campo-formulario campo-formulario--espacamento">
						<input type="text" name="email" id="email" />
						<label for="email">E-mail</label>
					</div>
					<div class="input-formulario campo-formulario campo-formulario--grande">
						<input type="password" name="senha" id="senha" />
						<label for="senha">Senha</label>
					</div>
					<input type="submit" class="botao primario" value="Login">
				</form>
			</div>
			<div class="imagem-carro">
				<img src="./assets/carro.png" alt="Imagem do carro" />
			</div>
		</div>
	</section>
</body>
<script type="module" src="js/validacoes.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const urlParams = new URLSearchParams(window.location.search);
    const erro = urlParams.get("erro");

    if (erro === "credenciais") {
      alert("Login ou senha inválidos!");
    }
  });
</script>
</html>