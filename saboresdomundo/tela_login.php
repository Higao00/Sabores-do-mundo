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
        #login{
            color: #FF8C00;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="darkModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog form-dark" role="document">
            <!--Content-->
            <div class="modal-content card card-image" style="background-image: url('images/pagina_principal.jfif');">
                <div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
                    <!--Header-->
                    <div class="modal-header text-center pb-4">
                        <h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>Entrar</strong></h3>
                        <button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        <!--Body-->
                        <div class="md-form mb-5">
                            <input type="email" id="Form-email5" class="form-control validate white-text">
                            <label data-error="wrong" data-success="right" for="Form-email5">E-mail</label>
                        </div>

                        <div class="md-form pb-3">
                            <input type="password" id="Form-pass5" class="form-control validate white-text">
                            <label data-error="wrong" data-success="right" for="Form-pass5">Senha</label>

                        </div>

                        <!--Grid row-->
                        <div class="row d-flex align-items-center mb-4">

                            <!--Grid column-->
                            <div class="text-center mb-3 col-md-12">
                                <button type="button" class="btn btn-amber">Entar</button>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">
                                <p class="font-small white-text d-flex justify-content-end">Não tem conta? <a href="#" class="orange-text ml-1 font-weight-bold">
                                        Cadastre-se</a></p>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                    </div>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Modal -->

    <div class="row">
        <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-lg-5">
            <div class="text-center">
                <a href="" class="btn btn-amber" data-toggle="modal" data-target="#darkModalForm">Fazer Login</a>
            </div>
        </div>
    </div>

    <div class="card mx-xl-6">


    </div>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

</body>

</html>