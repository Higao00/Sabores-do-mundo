<?php

error_reporting(0);
ini_set(“display_errors”, 0 );

if(isset($_SESSION['id_user'])){
    $logado = 1; 
}else{
    session_start();

    if(!isset($_SESSION['id_user'])){
        header('Location: home.php');
        die();
    }
}
?>

<?php
include 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
    img.d-block{
        max-height: 480px!important;
    }

    .checked {
      color: orange;
    }
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<!-- Card -->
<div class="container">
    <?php 

        include "src/conexao.php";
        include "src/Receita.php";
        include 'src/FotoReceita.php'; 
        include 'src/Ingrediente.php'; 
        include 'src/IngredienteReceita.php'; 

        isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;
        $receita_aux = new Receita();

        $aux = $receita_aux->executeQuery('SELECT * FROM `receita` WHERE `usuario` = '.$user);

        if (count($aux) > 0) {
            foreach ($aux as $key => $value) {
                ?>
                <div class="card" style="margin-top: 45px;">
                    <!-- Card content -->
                    <div class="card-body">
                        <!--Carousel Wrapper-->
                        <div id="carousel-<?php echo($key); ?>" class="carousel slide carousel-fade" data-ride="carousel">
                            <!--Indicators-->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-<?php echo($key); ?>" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-<?php echo($key); ?>" data-slide-to="1"></li>
                                <li data-target="#carousel-<?php echo($key); ?>" data-slide-to="2"></li>
                            </ol>
                            <!--/.Indicators-->
                            <!--Slides-->
                            <div class="carousel-inner" role="listbox">
                                <!--First slide-->
                                <?php 
                                    $aux_foto = '';

                                    $foto_receita = new FotoReceita();
                                    $aux_foto = $foto_receita->executeQuery('SELECT FR.id, FR.receita, FR.path_foto, FR.usuario, FR.timestamp FROM foto_receita AS FR INNER JOIN receita ON FR.receita = receita.id WHERE receita.id ='.$value->getId());

                                    if (count($aux_foto) > 0) {
                                        foreach ($aux_foto as $chave => $foto) {
                                            ?>
                                           <div class="carousel-item <?php if($chave == 0){echo 'active';} ?>">
                                               <img class="d-block w-100" src="<?php echo($foto->getPath_foto()); ?>" onclick="location.href='exibe_receita.php?id_receita=<?php echo($value->getId()); ?>'">
                                           </div>
                                           <?php
                                        }
                                    }
                                ?>
                               
                            </div>
                            <!--/.Slides-->
                            <!--Controls-->
                            <a class="carousel-control-prev" href="#carousel-<?php echo($key); ?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-<?php echo($key); ?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            <!--/.Controls-->
                        </div>
                        <br>
                        <!-- Title -->
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="card-title"><a style="font-size: 26px; font-weight: bold; text-transform: uppercase;" onclick="location.href='exibe_receita.php?id_receita=<?php echo($value->getId()); ?>'"><?php echo $value->getTitulo(); ?></a></h4>
                            </div>

                            <div class="col-sm-2">
                                <h5 class="font-weight-bold py-2" style="padding-top: 0px!important;"> <i class="far fa-clock"> </i> <?php echo number_format($value->getTempo_preparo(), 2, ':', ''); ?></h5>
                            </div>

                            <div class="col-sm-2">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="card" style="margin-top: 45px;">
                <!-- Card content -->
                <div class="card-body" align="center">
                    <i class="fas fa-grin-beam-sweat" style="font-size: 68px;"></i>
                    <p style="font-size: 28px; font-weight: bold; ">
                        Não há Receitas cadastradas nessa Categoria <br>Cadastre uma agora Mesmo !
                    </p>
                </div>
            </div>
            <?php  
        }
    ?>

   
</div>

<?php
include 'rodape.php';
?>

<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>
    $(document).ready(function(){
        $('a[href="lista_receita.php"]').parents('li').addClass('ativo');
    });
</script>

