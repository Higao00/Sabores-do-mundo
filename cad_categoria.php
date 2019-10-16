<?php

error_reporting(0);
ini_set(“display_errors”, 0 );

include 'src/conexao.php';
include 'src/Usuario.php';
include 'src/Categoria.php';

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

// if($_SESSION['id_user'] != 1){
//     header('Location: home.php');
//     die();
// }
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
            <h4 class="card-title">Cadastro de Categoria</h4>
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

                        <table class="table table-bordered table-responsive-md table-striped text-center" id="modo-preparo">
                            <thead>
                                <tr>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">Icone</th>
                                    <th class="text-center">Ação</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $randomic = rand(11111,99999);
                                ?>

                                <tr class="hide">
                                    <form class="text-center" action="control/categoria.php" method="POST" enctype="multipart/form-data" id="<?php echo($randomic);?>"></form>
                                    <input class="hide" type="text" name="id-categoria" value="-1" form="<?php echo($randomic);?>">
                                    <td class="pt-3-half" style="width: 55px!important;"><input class="form-control" type="text" name="nome" form="<?php echo($randomic);?>"  placeholder="Nome da categoria"></td>
                                    <td class="pt-3-half"> <input type="file" name="icone_categoria" accept="image/*" form="<?php echo($randomic);?>"></td>
                                    <td>
                                        <span class="table-change hide"><input type="button"class="btn btn-warning btn-rounded btn-sm my-0" value="Alterar"></span>
                                        <span class="table-save"><input type="submit" name="action" form="<?php echo($randomic);?>" class="btn btn-success btn-rounded btn-sm my-0" value="Salvar"></span>
                                    </td>
                                    <td>
                                        <span><input type="submit" form="<?php echo($randomic);?>" name="action" class="btn btn-danger btn-rounded btn-sm my-0" value="Remove"></span>
                                    </td>
                                </tr>

                                <?php 

                                $categoria = new Categoria();

                                $categorias = $categoria->selectAll();

                                foreach ($categorias as $key => $value) {

                                    $randomic = rand(11111,99999);
                                    ?>
                                    <tr>
                                        <form class="text-center" action="control/categoria.php" method="POST" enctype="multipart/form-data" id="<?php echo($randomic);?>"></form>
                                        <input class="hide" type="text" name="id-categoria" value="<?php echo($value->getId());  ?>" form="<?php echo($randomic);?>">
                                        <td class="pt-3-half"><input disabled class="form-control" required type="text" name="nome" form="<?php echo($randomic);?>" placeholder="Nome da Categoria" value="<?php echo($value->getTitulo());  ?>"></td>
                                        <td class="pt-3-half"> <input type="file" name="icone_categoria" required accept="image/*" form="<?php echo($randomic);?>"></td>
                                        <td>
                                            <span class="table-change"><input type="button"class="btn btn-warning btn-rounded btn-sm my-0" value="Alterar"></span>
                                            <span class="table-save hide"><input type="submit" name="action" class="btn btn-success btn-rounded btn-sm my-0" value="Salvar" form="<?php echo($randomic);?>"></span>
                                        </td>
                                        <td>
                                            <span><input type="submit" name="action" class="btn btn-danger btn-rounded btn-sm my-0" value="Remove" form="<?php echo($randomic);?>"></span>
                                        </td>
                                    </tr>
                                    <?php
                                }

                                ?>
                                
                            </tbody>
                        </table>
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

            $('a[href="cad_categoria.php"]').addClass('active');

            $(document).ready(function(){
                $('a[href="cad_categoria.php"]').parents('li').addClass('ativo');
            });


            const $tableID = $('.table');

            $(document).on('click', 'span.table-change', function(){

                $(this).addClass('hide');
                $(this).parents('td').find('> span.table-save').removeClass('hide');

                $(this).parents('tr').find('input[disabled]').each(function(){
                    $(this).removeAttr('disabled');
                });
            });

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

            <?php
            if (isset($_GET['status']) && $_GET['status'] == 1) {

                isset($_SESSION['msg']) ? $msg = $_SESSION['msg'] : $msg = '';
                ?>
                Swal.fire(
                    '<?php echo ($msg); ?>',
                    '',
                    'success'
                );
            <?php
            } elseif (isset($_GET['status']) && $_GET['status'] == 0) {

                isset($_SESSION['msg']) ? $msg = $_SESSION['msg'] : $msg = '';
                ?>
                Swal.fire(
                    '<?php echo ($msg); ?>',
                    '',
                    'error'
                );
            <?php
            }

            ?>
        });

    </script>
</div>

</div>
<!--Main layout-->