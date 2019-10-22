<?php 
if(isset($_SESSION) && isset($_SESSION['id_user'])){
	$logado = 1; 
}else{
	session_start();

	if(isset($_SESSION['id_user'])){
		$logado = 1; 
	}else{
		$logado = 0; 
	}
}

include "src/conexao.php";
include "src/Pais.php";
include "src/Categoria.php";
include "src/Usuario.php";
include "src/Receita.php";
include 'src/FotoReceita.php'; 
include 'src/Ingrediente.php'; 
include 'src/IngredienteReceita.php';
include 'src/Avaliacao.php';
include 'src/ReceitaFavorita.php';
include 'src/Util.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="theme-color" content="#ff2e17">
	<title>Sabores do Mundo</title>
	<link rel="apple-touch-icon" href="images/icons/icon-192x192.png">
	<link rel="shortcut icon" href="images/icons/icon-72x72.ico" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="css/mdb.min.css" rel="stylesheet">
	<!-- Your custom styles (optional) -->
	<link href="css/style.min.css" rel="stylesheet">
	<link rel="manifest" href="/saboresdomundo/manifest.json">
	<link rel="stylesheet" href="css/sweetalert2.min.css">
	<link href="css/dropzone.min.css" rel="stylesheet" />

	<style>
		.suspenso{
			display: none!important;
		}

		form#form_principal {
			margin: 2% !important;
			margin-left: 0px !important;
			margin-right: 0px !important;
		}

		.bold-1 {
			font-weight: 500;
		}

		.list-group-item.active {
			background-color: #e64a19 !important;
			border-color: #e64a19 !important;
		}
	</style>

	<style>
		.form-dark .font-small {
			font-size: 0.8rem;
		}

		.form-dark .md-form label {
			color: #fff;
		}

		.form-dark input[type=email]:focus:not([readonly]) {
			border-bottom: 1px solid #FF8C00;
			-webkit-box-shadow: 0 1px 0 0 #FF8C00;
			box-shadow: 0 1px 0 0 #FF8C00;
		}

		.form-dark input[type=email]:focus:not([readonly])+label {
			color: #fff;
		}

		.form-dark input[type=password]:focus:not([readonly]) {
			border-bottom: 1px solid #FF8C00;
			-webkit-box-shadow: 0 1px 0 0 #FF8C00;
			box-shadow: 0 1px 0 0 #FF8C00;
		}

		.form-dark input[type=password]:focus:not([readonly])+label {
			color: #fff;
		}

		.form-dark .modal-header {
			border-bottom: none;
		}

		#login {
			color: #FF8C00;
		}

		.form-dark .font-small {
			font-size: 0.8rem;
		}

		.form-dark .md-form label {
			color: #fff;
		}

		.form-dark input[type=email]:focus:not([readonly]) {
			border-bottom: 1px solid #FF8C00;
			-webkit-box-shadow: 0 1px 0 0 #FF8C00;
			box-shadow: 0 1px 0 0 #FF8C00;
		}

		.form-dark input[type=email]:focus:not([readonly])+label {
			color: #fff;
		}

		.form-dark input[type=password]:focus:not([readonly]) {
			border-bottom: 1px solid #FF8C00;
			-webkit-box-shadow: 0 1px 0 0 #FF8C00;
			box-shadow: 0 1px 0 0 #FF8C00;
		}

		.form-dark input[type=password]:focus:not([readonly])+label {
			color: #fff;
		}

		.form-dark .modal-header {
			border-bottom: none;
		}

		#paises {
			background-color: #ffde75;
			overflow-y: scroll;
			max-height: 400px;
		}
		img#logo{
			width: 100%!important;
		}

		.modal-dialog.modal-notify.modal-info .fab,
		.modal-dialog.modal-notify.modal-info .far,
		.modal-dialog.modal-notify.modal-info .fas {
			color: rgb(255, 46, 23);
		}

		.modal-dialog.modal-notify.modal-info .badge,
		.modal-dialog.modal-notify.modal-info .modal-header {
			background-color: rgb(255, 46, 23);
		}

		a.list-group-item{
			font-size: 17px!important;
			font-weight: bold;
		}

		/*Botao Flutuante*/
		.fab{
			display: none;
			position: fixed;
			bottom:10px;
			right:10px;
		}

		.fab button{
			cursor: pointer;
			width: 48px;
			height: 48px;
			border-radius: 30px;
			background-color: #cb60b3;
			border: none;
			box-shadow: 0 1px 5px rgba(0,0,0,.4);
			font-size: 24px;
			color: white;

			-webkit-transition: .2s ease-out;
			-moz-transition: .2s ease-out;
			transition: .2s ease-out;
		}

		.fab button.main{
			position: absolute;
			width: 60px;
			height: 60px;
			border-radius: 30px;
			background-color: #b30000;
			right: 0;
			bottom: 0;
			z-index: -1!important;
		}

		.fab button.main:before{
			content: '+';
		}

		img#icon-mobile{
			display: none;
		}

		strong#titulo-mobile{
			font-size: 20px!important;
			font-weight: bold!important;
			text-transform: uppercase!important;
		}

		.list-group-item{
			color: #000;
		}

		li.ativo{
			border-radius: 5px!important;
			background: #F84A35!important;
		}
		li.ativo > a{
			color: #FFF!important;
		}
	</style>

	<style type="text/css">
		@media only screen and (max-width: 450px) {
			p#icon_fade_mobile {
				display: none;
			}

			.suspenso{
				display: inline-block!important;
			}

			.fab{
				display: block!important;
			}

			img#icon-mobile{
				display: inline-block!important;
			}
		}
	</style>
</head>

<body class="grey lighten-3">

	<!--Main Navigation-->
	<header>

		<!-- Navbar -->
		<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
			<div class="container-fluid">

				<a class="navbar-brand waves-effect" href="#">
					<img src="images/icons/icon-96x96.png" style="width: 45px;" id="icon-mobile">
					<strong class="bold-1" style="color: #ca0303;" id="titulo-mobile">Sabores do Mundo</strong>
				</a>

				<!-- Collapse -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Links -->
				<div class="collapse navbar-collapse" id="navbarSupportedContent">

					<!-- Left -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a href="home.php" class="nav-link waves-effect bold-1 suspenso">
								<i class="fas fa-home mr-3 suspenso"></i>Home
							</a>
						</li>
						<li class="nav-item" id="top_receita">
							<a href="lista_receita.php?tipo=top_receita" class="nav-link waves-effect bold-1">
								<i class="fas fa-star mr-3 suspenso"></i>Melhores Receitas
							</a>
						</li>

						<?php 
						if($logado == 1){
							?>
							<li class="nav-item" id="minhas-receitas">
								<a href="lista_receita.php?tipo=self" class="nav-link waves-effect bold-1">
									<i class="fas fa-book-open mr-3 suspenso"></i>Minhas Receitas
								</a>
							</li>
							<?php
						}
						?>

						<li class="nav-item" id="pais-receita">
							<a href="#" id="dropdownMenuButton" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#pais">
								<i class="fas fa-flag mr-3 suspenso"></i>
								Receitas Estrangeiras 
							</a>
						</li>

						<li class="nav-item" id="categoria-receita">
							<a href="#" id="dropdownMenuButton" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#categoria">
								<i class="fas fa-dumpster mr-3 suspenso"></i>
								Categoria de Receitas
							</a>
						</li>

						<?php 
						if($logado == 1){
							?>
							<li class="nav-item suspenso" id="favoritas">
								<a href="lista_receita.php?tipo=favoritas" class="nav-link waves-effect bold-1">
									<i class="fas fa-heart mr-3"></i>Receitas Favoritas
								</a>
							</li>
							<?php
						}
						?>

						<?php 
						if($logado == 1){
							?>
							<li class="nav-item suspenso">
								<a href="perfil.php" class="nav-link waves-effect bold-1">
									<i class="fas fa-user mr-3"></i>Perfil
								</a>
							</li>
							<?php
						}
						?>

						<?php 
						if(isset($_SESSION['id_user']) && $_SESSION['id_user'] == 1){
							?>
							<li class="nav-item suspenso">
								<a href="cad_pais.php" class="nav-link waves-effect bold-1">
									<i class="fas fa-plus mr-3"></i>Cadastrar Pais
								</a>
							</li>
							<?php
						}
						?>

						<?php 
						if(isset($_SESSION['id_user']) && $_SESSION['id_user'] == 1){
							?>
							<li class="nav-item suspenso">
								<a href="cad_categoria.php" class="nav-link waves-effect bold-1">
									<i class="fas fa-plus mr-3"></i>Cadastrar Categoria
								</a>
							</li>
							<?php
						}
						?>

						<li class="nav-item suspenso">
							<a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#configuracao">
								<i class="fas fa-cogs mr-3"></i>Notificações
							</a>
						</li> 

						<?php 
						if($logado == 1){
							?>
							<li class="nav-item suspenso">
								<a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#sair">
									<i class="fas fa-sign-out-alt mr-3"></i>Sair
								</a>
							</li>
							<?php
						}
						?>

						<?php 
						if($logado != 1){
							?>
							<li class="nav-item suspenso">
								<a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#cadastro"><i class="fas mr-3 fa-user-friends"></i>Cadastrar-se
								</a>
							</li>
							<?php
						}
						?>

						<?php 
						if($logado != 1){
							?>
							<li class="nav-item suspenso">
								<a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#login"><i class="fas mr-3 fa-sign-in-alt"></i>Fazer Login
								</a>

							</li>
							<?php
						}
						?>

					</ul>
				</div>
			</div>
		</nav>
		<!-- Navbar -->

		<!-- Sidebar -->
		<div class="sidebar-fixed position-fixed">

			<img src="images/logo.png" id="logo" onclick="window.location='home.php'">

			<div class="list-group list-group-flush">

				<a href="home.php" class="list-group-item list-group-item-action waves-effect">
					<i class="fas fa-home mr-3"></i>Home</a>

					<?php 
					if($logado == 1){
						?>
						<a href="cadastro_receita.php" class="list-group-item list-group-item-action waves-effect">
							<i class="fas fa-utensils mr-3"></i>Nova Receita
						</a>
						<?php
					}
					?>

					<?php 
					if($logado == 1){
						?>
						<a href="lista_receita.php?tipo=favoritas" class="list-group-item list-group-item-action waves-effect">
							<i class="fas fa-star mr-3"></i>Receitas Favoritas
						</a>
						<?php
					}
					?>

					<?php 
					if($logado == 1){
						?>
						<a href="perfil.php" class="list-group-item list-group-item-action waves-effect">
							<i class="fas fa-user mr-3"></i>Perfil
						</a>
						<?php
					}
					?>

					<?php 
					if(isset($_SESSION['id_user']) && $_SESSION['id_user'] == 1){
						?>
						<a href="cad_pais.php" class="list-group-item list-group-item-action waves-effect">
							<i class="fas fa-plus mr-3"></i>Cadastrar Pais
						</a>
						<?php
					}
					?>

					<?php 
					if(isset($_SESSION['id_user']) && $_SESSION['id_user'] == 1){
						?>
						<a href="cad_categoria.php" class="list-group-item list-group-item-action waves-effect" style="font-size: 14px!important;">
							<i class="fas fa-plus mr-3" style="font-size: 18px!important;"></i>Cadastrar Categoria
						</a>
						<?php
					}
					?>

					<?php 
					if($logado == 1){
						?>
						<a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#sair">
							<i class="fas fa-sign-out-alt mr-3"></i>Sair
						</a>
						<?php
					}
					?>
					<?php 
					if($logado != 1){
						?>
						<a href="" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#cadastro"><i class="fas fa-user-plus mr-3"></i>Cadastrar-se
						</a>
						<?php
					}
					?>
					<?php 
					if($logado != 1){
						?>
						<a href="" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt mr-3"></i>Fazer Login
						</a>
						<?php
					}
					?>


					<a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#configuracao">
						<i class="fas fa-cogs mr-3"></i>Notificações
					</a>

				</div>

			</div>
			<!-- Sidebar -->
		</header>
		<!--Main Navigation-->

		<!--Main layout-->
		<main class="pt-5 mx-lg-5" style="padding-top: 3%!important; padding-bottom: 3%!important;">
