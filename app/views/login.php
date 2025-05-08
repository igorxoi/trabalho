<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<div class="login-container">
		<form action="index.php?url=login/authenticate" method="POST">
			<input type="text" name="email" placeholder="E-mail" required>
			<input type="password" name="senha" placeholder="Senha" required>
			<button type="submit">Entrar</button>
		</form>
	</div>
	</body>
</html>
