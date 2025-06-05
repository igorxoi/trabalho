<?php require_once(__DIR__ . '/../helpers/utils.php'); ?>

<nav class="sidebar">
	<div class="logo">
		<img src="./assets/logo.png" alt="Logo" />
		<h1 class="nome-estaciona-aqui">Estaciona<b>A</b>qui!</h1>
	</div>
	<ul class="menu">
		<?php if (verificarPermissaoItemMenu('dashboard')): ?>
			<a href="index.php?url=estacionamento/dashboard">
				<li class="item-menu <?php echo (verificarMenuAtivo(["estacionamento/dashboard"])) ?>">
					<i class="material-symbols-outlined">dashboard</i>
					<span>Dashboard</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('cadastro_veiculo')): ?>
			<a href="index.php?url=veiculo/cadastro">
				<li class="item-menu <?php echo (verificarMenuAtivo(["veiculo/cadastro"])) ?>">
					<i class="material-symbols-outlined">add</i>
					<span>Cadastro de Veículo</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu(item: 'gerenciamento')): ?>
			<a href="index.php?url=estacionamento/gerenciar">
				<li class="item-menu <?php echo (verificarMenuAtivo(["estacionamento/gerenciar"])) ?>">
					<i class="material-symbols-outlined">car_gear</i>
					<span>Gerenciar Estacionamento</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('historico')): ?>
			<a href="index.php?url=estacionamento/historico">
				<li class="item-menu <?php echo (verificarMenuAtivo(["estacionamento/historico"])) ?>">
					<i class="material-symbols-outlined">lists</i>
					<span>Histórico</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('cadastro_usuario')): ?>
			<a href="index.php?url=usuario/listar">
				<li class="item-menu <?php echo (verificarMenuAtivo(["usuario/listar", "usuario/cadastro"])) ?>">
					<i class="material-symbols-outlined">person_add</i>
					<span>Cadastrar usuários</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (verificarPermissaoItemMenu('configuracoes')): ?>
			<a href="index.php?url=estacionamento/configuracoes">
				<li class="item-menu <?php echo (verificarMenuAtivo(["estacionamento/configuracoes"])) ?>">
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