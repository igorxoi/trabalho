<?php require_once(__DIR__ . '/../helpers/utils.php'); ?>

<nav class="sidebar">
	<div class="logo">
		<img src="" alt="Logo" />
	</div>
	<ul class="menu">
		<?php if (userHasPermission('dashboard')): ?>
			<a href="index.html">
				<li class="item-menu">
					<i class="material-symbols-outlined">dashboard</i>
					<span>Dashboard</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (userHasPermission('cadastro_veiculo')): ?>
			<a href="cadastro.html">
				<li class="item-menu">
					<i class="material-symbols-outlined">add</i>
					<span>Cadastro de Veículo</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (userHasPermission('gerenciamento')): ?>
			<a href="gerenciar.html">
				<li class="item-menu ativo">
					<i class="material-symbols-outlined">car_gear</i>
					<span>Gerenciar Estacionamento</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (userHasPermission('historico')): ?>
			<a href="historico.html">
				<li class="item-menu">
					<i class="material-symbols-outlined">lists</i>
					<span>Histórico</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (userHasPermission('cadastro_usuario')): ?>
			<a href="configuracoes.html">
				<li class="item-menu">
					<i class="material-symbols-outlined">person_add</i>
					<span>Cadastrar usuários</span>
				</li>
			</a>
		<?php endif; ?>

		<?php if (userHasPermission('configuracoes')): ?>
			<a href="configuracoes.html">
				<li class="item-menu">
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