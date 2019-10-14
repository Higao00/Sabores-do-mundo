<?php

error_reporting(0);
ini_set(“display_errors”, 0 );

include 'src/conexao.php';
include 'src/Usuario.php';
include 'src/Pais.php';

if(isset($_SESSION['id_user'])){
    $logado = 1; 
}else{
    session_start();

    if(isset($_SESSION['id_user'])){
        $user = new Usuario();

        $user->selectUserId($_SESSION['id_user']);
    }else{
        header('Location: index.php');
        die();
    }
}
?>

<?php 
    include 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
    img#perfil {
        margin-top: 10%;
    }

    div#menu {
        text-align: center;
    }

    a.list-group-item {
        text-align: left;
    }

    .hide{
        display: none;
    }
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container">
    <!-- Card -->
    <div class="card testimonial-card" style="margin-top: 4%;">

        <!-- Background color -->
        <div class="card-up indigo lighten-1"></div>

        <!-- Content -->
        <div class="card-body">
            <!-- Name -->
            <h4 class="card-title">Cadastro de Pais</h4>
            <hr>
            <!-- Card -->
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                    <div class="table table-editable" style="overflow:scroll;height:400px;width:100%;overflow:auto">
                       <!--  <span class="table-add mb-3 mr-2">
                            <a style="font-size: 24px; font-weight: 500; color: #000;">Modo de Preparo</a>
                        </span> -->
                        <a class="table-add text-success float-right fas fa-plus fa-2x" aria-hidden="true" tabela="modo-preparo"></a>

                        <form class="form list-margin" action="control/receita.php" name="cad-receita" method="POST">
                            <input type="text" name="id-pais" class="hide">
                            <table class="table table-bordered table-responsive-md table-striped text-center" id="modo-preparo">
                                <thead>
                                    <tr>
                                        <th class="text-center">Pais</th>
                                        <th class="text-center">Localidade</th>
                                        <th class="text-center">Icone</th>
                                        <th class="text-center">Alterar</th>
                                        <th class="text-center">Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 

                                    $pais = new Pais();

                                    $paises = $pais->

                                    ?>
                                    <tr class="hide">
                                        <td class="pt-3-half"><input class="form-control" type="text" name="pais[]"  placeholder="Nome do Pais"></td>
                                        <td class="pt-3-half"><input class="form-control" type="text" name="localidade[]"  placeholder="Localidade"></td>
                                        <td class="pt-3-half"> <input type="file" name="icone_pais" accept="image/*"></td>
                                        <td>
                                            <span class="table-change"><button type="button" class="btn btn-warning btn-rounded btn-sm my-0">Alterar</button></span>
                                            <span class="table-save hide"><button type="button" class="btn btn-success btn-rounded btn-sm my-0">Salvar</button></span>
                                        </td>
                                        <td>
                                            <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="pt-3-half"><input class="form-control" required type="text" name="localidade[]"  placeholder="Nome do Pais"></td>
                                        <td class="pt-3-half"><input class="form-control" required type="text" name="pais[]"  placeholder="Localidade"></td>
                                        <td class="pt-3-half"> <input type="file" name="icone_pais" required accept="image/*"></td>
                                        <td>
                                            <span class="table-change hide"><button type="button" class="btn btn-warning btn-rounded btn-sm my-0">Alterar</button></span>
                                            <span class="table-save"><button type="button" class="btn btn-success btn-rounded btn-sm my-0">Salvar</button></span>
                                        </td>
                                        <td>
                                            <span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <!-- Card -->
            </div>

        </div>
        <!-- Card -->
    </div>

    <?php
    include 'rodape.php';
    ?>

    <!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
    <script>

        $(document).ready(function(){
            $('a[href="cad_pais.php"]').addClass('active');

            const $tableID = $('.table');

            $(document).on('click', 'a.table-add', function(){

                var table = $(this).attr('tabela');
                var tabela = $('table#'+table);

                var $clone = tabela.find('> tbody > tr.hide').clone(true).removeClass('hide');

                $clone.find('input').each(function(){
                    $(this).attr('required', 'true');
                });

                tabela.find('> tbody').append($clone);
            });

            $tableID.on('click', '.table-remove', function() {
                $(this).parents('tr').detach();
            });
        });

    </script>

</div>
<!--Main layout-->