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

</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container">
    <div class="card" style="margin-top: 45px;">
        <!-- Card content -->
        <div class="card-body">
            <h4 class="card-title "><a><?php echo $receita->getTitulo(); ?></a></h4>
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
            <div class="row" align="center">
                <div class="col-sm-4">
                    <h6 class="font-weight-bold py-2"> <i class="fas fa-cheese"></i> 4 Porções</h6>
                </div>

                <div class="col-sm-4">
                    <h6 class="font-weight-bold indigo-text py-2"> <i class="far fa-clock"></i> 50:00 </h6>
                </div>

                <div class="col-sm-4">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12" align="center">
                    <p style="font-size: 24px; font-weight: bold;">INGREDIENTES</p>
                </div>
                <div class="col-sm-12">
                    <ul class="list-group list-group-flush">
                    <?php 

                        $ingre_receita = new IngredienteReceita();
                        $aux_ingre = $ingre_receita->executeQuery("SELECT * FROM `ingrediente_receita` WHERE `receita` = ".$receita->getId());

                        foreach ($aux_ingre as $key => $value) {
                            $ingrediente = new Ingrediente();

                            $ingrediente->selectIngredienteId($value->getIngrediente());
                        }

                        ?>
                        <li class="list-group-item"><?php echo ($key+1).' '.$ingrediente->getNome().' '.$ingrediente->getMedida().' '.$value->getQuantidade(); ?></li>
                        <?php
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
