<?php

error_reporting(0);
ini_set(“display_errors”, 0 );

if(isset($_SESSION['id_user'])){
    $logado = 1; 
}else{
    session_start();

    if(!isset($_SESSION['id_user']) || !isset($_GET['id_receita'])){
        header('Location: home.php');
        die();
    }
}

include "src/conexao.php";
include "src/Receita.php";
include 'src/FotoReceita.php'; 
include 'src/Ingrediente.php'; 
include 'src/IngredienteReceita.php';

$receita = new Receita();

$receita->selectReceitaId($_GET['id_receita']);

?>

<?php 
include 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
    img.d-block{
        max-height: 480px!important;
    }

    .destaque{
        font-size: 20px;
        text-transform: uppercase;

    }
    .destaque > b{
        font-size: 26px;
        text-transform: uppercase;
        font-weight: bold;
    }
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container-fluid" style="padding: 45px;">

    <div class="card">
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
                        $aux_foto = $foto_receita->executeQuery('SELECT FR.id, FR.receita, FR.path_foto, FR.usuario, FR.timestamp FROM foto_receita AS FR INNER JOIN receita ON FR.receita = receita.id WHERE receita.id ='.$receita->getId());

                        if (count($aux_foto) > 0) {
                            foreach ($aux_foto as $chave => $foto) {
                                ?>
                               <div class="carousel-item <?php if($chave == 0){echo 'active';} ?>">
                                   <img class="d-block w-100" src="<?php echo($foto->getPath_foto()); ?>">
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
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carousel-<?php echo($key); ?>" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
                <!--/.Controls-->
            </div>
            <br>
            <!-- Title -->
            <div class="row">

                <div class="col-sm-6">
                    <h4 class="card-title"><a style="font-size: 24px;"><?php echo $receita->getTitulo(); ?></a></h4>
                </div>

                <div class="col-sm-2 col-6">
                    <h6 class="font-weight-bold indigo-text py-2" style="padding-top: 0px!important;"> <i class="far fa-clock"></i> <?php echo number_format($receita->getTempo_preparo(), 2, ':', ''); ?></h6>
                </div>

                <div class="col-sm-2 col-6">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>

                <div class="col-sm-12" align="center">
                    <a href="#" class="btn btn-success">Adicionar Foto</a>
                </div>
            </div>

           
        </div>
    </div>

    <div class="card" style="margin-top: 45px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" align="center">
                    <p style="font-size: 24px; font-weight: bold;">INGREDIENTES</p>
                </div>
                <div class="col-sm-12">
                    <ul class="list-group">
                    <?php 

                        $ingre_receita = new IngredienteReceita();
                        $aux_ingre = $ingre_receita->executeQuery("SELECT * FROM `ingrediente_receita` WHERE `receita` = ".$receita->getId());

                        
                        foreach ($aux_ingre as $key => $value) {
                            $ingrediente = new Ingrediente();
                            $ingrediente->selectIngredienteId($value->getIngrediente());
                        ?>
                        <li class="list-group-item destaque"><?php echo '<b>'.($key+1).' - </b>  '.$value->getQuantidade().' '.$ingrediente->getMedida().' de '.$ingrediente->getNome(); ?></li>
                        <?php
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top: 45px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12" align="center">
                    <p style="font-size: 24px; font-weight: bold;">MODO DE PREPARO</p>
                </div>
                <div class="col-sm-12">
                    <ul class="list-group">
                    <?php 

                        echo $receita->getModo_preparo();
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include 'rodape.php';
?>

<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>


</script>
