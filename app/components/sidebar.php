<?php require_once(__DIR__ . '/../helpers/utils.php'); ?>

<nav class="sidebar">
	<div class="logo">
		<img src="./assets/logo.png" alt="Logo" />
		<h1 class="nome-estaciona-aqui">Estaciona<b>A</b>qui!</h1>
	</div>
	<ul class="menu">
		<?php if (verificarPermissaoItemMenu('dashboard')): ?>
			<a href="index.html">
				<li class="item-menu <?php echo(verificarMenuAtivo("gerenciar")) ?>">
					<i class="material-symbols-outlined">dashboard</i>
					<span>Dashboard</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('cadastro_veiculo')): ?>
			<a href="index.php?url=cadastro/index">
				<li class="item-menu <?php echo(verificarMenuAtivo("cadastro")) ?>">
					<i class="material-symbols-outlined">add</i>
					<span>Cadastro de Veículo</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu(item: 'gerenciamento')): ?>
			<a href="index.php?url=estacionamento/index">
				<li class="item-menu <?php echo(verificarMenuAtivo("estacionamento")) ?>">
					<i class="material-symbols-outlined">car_gear</i>
					<span>Gerenciar Estacionamento</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('historico')): ?>
			<a href="index.php?url=historico/index">
				<li class="item-menu <?php echo(verificarMenuAtivo("historico")) ?>">
					<i class="material-symbols-outlined">lists</i>
					<span>Histórico</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('cadastro_usuario')): ?>
			<a href="index.php?url=cadastroUsuario/index">
				<li class="item-menu <?php echo(verificarMenuAtivo("cadastroUsuario")) ?>">
					<i class="material-symbols-outlined">person_add</i>
					<span>Cadastrar usuários</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('configuracoes')): ?>
			<a href="index.php?url=configuracoes/index">
				<li class="item-menu <?php echo(verificarMenuAtivo("configuracoes")) ?>">
					<i class="material-symbols-outlined">settings</i>
					<span>Configurações</span>
				</li>
			</a>
		<?php endif; ?>

		<li class="logout" onclick="expandirMenu()">
			<i class="material-symbols-outlined icon-menu">arrow_menu_open</i>
			<span>Recolher</span>
		</li>
	</ul>
</nav>