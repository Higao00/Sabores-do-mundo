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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sabores do Mundo</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <link rel="manifest" href="/saboresdomundo/manifest.json">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@8.18.0/dist/sweetalert2.min.css">


    <style>
        @media only screen and (max-width: 600px) {
            p#icon_fade_mobile {
                display: none;
            }

            .suspenso{
                display: inline-block!important;
            }
        }

        .suspenso{
            display: none;
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
    </style>
</head>

<body class="grey lighten-3">

    <!--Main Navigation-->
    <header>

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container-fluid">

                <a class="navbar-brand waves-effect" href="#">
                    <strong class="bold-1" style="color: #f4511e;">Sabores do Mundo</strong>
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
                            <a href="#" class="nav-link waves-effect bold-1">
                            <i class="fas fa-home mr-3 suspenso"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link waves-effect bold-1">
                            <i class="fas fa-star mr-3 suspenso"></i>Melhores Receitas</a>
                        </li>

                        <?php 
                            if($logado == 1){
                                ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link waves-effect bold-1">
                                    <i class="fas fa-book-open mr-3 suspenso"></i>Minhas Receitas</a>
                                </li>
                                <?php
                            }
                        ?>
                        
                        <li class="nav-item">
                            <a href="#" id="dropdownMenuButton" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#pais">
                            <i class="fas fa-flag mr-3 suspenso"></i>
                                Receitas Estrangeiras 
                            </a>
                        </li>

                        <?php 
                            if($logado == 1){
                                ?>
                                <li class="nav-item suspenso">
                                    <a href="#" class="nav-link waves-effect bold-1">
                                    <i class="fas fa-heart mr-3"></i>Receitas Favoritas</a>
                                </li>
                                <?php
                            }
                        ?>

                        <?php 
                            if($logado == 1){
                                ?>
                                <li class="nav-item suspenso">
                            		<a href="pefil.php" class="nav-link waves-effect bold-1">
                            			<i class="fas fa-user mr-3"></i>Perfil
                            		</a>
                            	</li>
                                <?php
                            }
                        ?>

                        
                       
                        <li class="nav-item suspenso">
                            <a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#configuracao">
                            <i class="fas fa-cogs mr-3"></i>Notificações</a>
                        </li> 

                        <?php 
                            if($logado == 1){
                                ?>
                                <li class="nav-item suspenso">
                                    <a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#sair">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Sair</a>
                                </li>
                                <?php
                            }
                        ?>

                        <?php 
                            if($logado != 1){
                                ?>
                                <li class="nav-item suspenso">
                                    <a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#cadastro"><i class="fas mr-3 fa-user-friends"></i>Cadastrar-se</a>
                                </li>
                                <?php
                            }
                        ?>

                        <?php 
                            if($logado != 1){
                                ?>
                                <li class="nav-item suspenso">
		                            <a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#login"><i class="fas mr-3 fa-sign-in-alt"></i>Fazer Login</a>
		                           
		                       </li>
                                <?php
                            }
                        ?>
                       
                    </ul>


                </div>

                <form class="form-inline" id="busca_principal" style="padding: 0px!important;">
                    <input class="form-control" id="busca_principal" type="text" placeholder="Pesquise Aqui" aria-label="Pesquise Aqui">
                </form>

                <div class="collapse navbar-collapse" align="right">
                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item">
                            <a href="#" class="nav-link waves-effect" target="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->

        <!-- Sidebar -->
        <div class="sidebar-fixed position-fixed">

            <img src="images/logo.png" id="logo">

            <div class="list-group list-group-flush">

            	<?php 
            	    if($logado == 1){
            	        ?>
            	        <a href="#" class="list-group-item list-group-item-action waves-effect">
                    	<i class="fas fa-star mr-3"></i>Receitas Favoritas</a>
            	        <?php
            	    }
            	?>
            	<?php 
            	    if($logado == 1){
            	        ?>
            	        <a href="perfil.php" class="list-group-item list-group-item-action waves-effect">
                    	<i class="fas fa-user mr-3"></i>Perfil</a>
            	        <?php
            	    }
            	?>
            	<?php 
            	    if($logado == 1){
            	        ?>
            	        <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#sair">
                    	<i class="fas fa-sign-out-alt mr-3"></i>Sair</a>
            	        <?php
            	    }
            	?>
            	<?php 
            	    if($logado != 1){
            	        ?>
            	        <a href="" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#cadastro"><i class="fas fa-user-plus mr-3"></i>Cadastrar-se</a>
            	        <?php
            	    }
            	?>
            	<?php 
            	    if($logado != 1){
            	        ?>
            	        <a href="" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt mr-3"></i>Fazer Login</a>
            	        <?php
            	    }
            	?>
                
                
                <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#configuracao">
                    <i class="fas fa-cogs mr-3"></i>Notificações</a>
                
            </div>

        </div>
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="pt-5 mx-lg-5">
        