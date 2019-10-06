<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <link rel="manifest" href="/SaboresDoMundo/manifest.json">


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
                            <i class="fas fa-home"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link waves-effect bold-1">
                            <i class="fas fa-star mr-3 suspenso"></i>Melhores Receitas</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link waves-effect bold-1">
                            <i class="fas fa-book-open"></i>Minhas Receitas</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a id="dropdownMenuButton" class="nav-link waves-effect bold-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-flag"></i>
                                    Receitas Estrangeiras 
                                </a>
                                <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" id="paises">
                                    <a class="dropdown-item" href="#"><img src="images/icon_australia.png" alt="">Australia</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_brasil.png" alt="">Brasil</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_china.png" alt="">China</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_espanha.png" alt="">Espanha</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_franca.png" alt="">França</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_inglaterra.png" alt="">Inglaterra </a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_italia.png" alt="">Italia</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_japao.png" alt="">Japão</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_mexico.png" alt="">Mexico</a>
                                    <a class="dropdown-item" href="#"><img src="images/icon_tailandia.png" alt="">Tailandia</a>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item suspenso">
                            <a href="#" class="nav-link waves-effect bold-1">
                            <i class="fas fa-heart"></i>Receitas Favoritas</a>
                        </li>
                        <li class="nav-item suspenso">
                            <a href="pefil.php" class="nav-link waves-effect bold-1">
                                <i class="fas fa-user mr-3"></i>Perfil</a>
                        </li>
                        <li class="nav-item suspenso">
                            <a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#configuracao">
                                <i class="fas fa-cogs mr-3"></i>Notificações</a>
                        </li> 
                        <li class="nav-item suspenso">
                            <a href="#" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#sair">
                                <i class="fas fa-sign-out-alt mr-3"></i>Sair</a>
                        </li>
                        <li class="nav-item suspenso">
                            <a href="" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#cadastro"><i class="fas fa-user-friends"></i>Cadastrar-se</a>
                        </li>
                       <li class="nav-item suspenso">
                            <a href="" class="nav-link waves-effect bold-1" data-toggle="modal" data-target="#login"><i class="fas fa-sign-in-alt"></i>Fazer Login</a>
                           
                       </li>
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

            <a class="logo-wrapper waves-effect">
                <p id="icon" style="text-shadow: rgb(179, 32, 16) 0px 0px 0px, rgb(181, 33, 16) 1px 1px 0px, rgb(183, 33, 17) 2px 2px 0px, rgb(186, 33, 17) 3px 3px 0px, rgb(188, 34, 17) 4px 4px 0px, rgb(190, 34, 17) 5px 5px 0px, rgb(193, 35, 17) 6px 6px 0px, rgb(195, 35, 18) 7px 7px 0px, rgb(198, 36, 18) 8px 8px 0px, rgb(200, 36, 18) 9px 9px 0px, rgb(202, 37, 18) 10px 10px 0px, rgb(205, 37, 18) 11px 11px 0px, rgb(207, 37, 19) 12px 12px 0px, rgb(210, 38, 19) 13px 13px 0px, rgb(212, 38, 19) 14px 14px 0px, rgb(214, 39, 19) 15px 15px 0px, rgb(217, 39, 20) 16px 16px 0px, rgb(219, 40, 20) 17px 17px 0px, rgb(222, 40, 20) 18px 18px 0px, rgb(224, 40, 20) 19px 19px 0px, rgb(226, 41, 20) 20px 20px 0px, rgb(229, 41, 21) 21px 21px 0px, rgb(231, 42, 21) 22px 22px 0px, rgb(233, 42, 21) 23px 23px 0px, rgb(236, 43, 21) 24px 24px 0px, rgb(238, 43, 21) 25px 25px 0px, rgb(241, 43, 22) 26px 26px 0px, rgb(243, 44, 22) 27px 27px 0px, rgb(245, 44, 22) 28px 28px 0px, rgb(248, 45, 22) 29px 29px 0px, rgb(250, 45, 23) 30px 30px 0px, rgb(253, 46, 23) 31px 31px 0px; font-size: 58px; color: rgb(255, 255, 255); height: 139px; width: 139px; line-height: 139px; border-radius: 17%; text-align: center; background-color: rgb(255, 46, 23);"> SM </p>

            </a>

            <div class="list-group list-group-flush">

                <a href="#" class="list-group-item list-group-item-action waves-effect">
                    <i class="fas fa-star mr-3"></i>Receitas Favoritas</a>
                <a href="perfil.php" class="list-group-item list-group-item-action waves-effect">
                    <i class="fas fa-user mr-3"></i>Perfil</a>
                <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#configuracao">
                    <i class="fas fa-cogs mr-3"></i>Notificações</a>
                <a href="#" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#sair">
                    <i class="fas fa-sign-out-alt mr-3"></i>Sair</a>
                <a href="" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#cadastro"><i class="fas fa-stream mr-3"></i>Cadastrar-se</a>
                <a href="" class="list-group-item list-group-item-action waves-effect" data-toggle="modal" data-target="#login"><i class="fas fa-stream mr-3"></i>Fazer Login</a>

            </div>

        </div>
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="pt-5 mx-lg-5">
        