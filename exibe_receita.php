<?php

// error_reporting(0);
// ini_set(“display_errors”, 0 );

if(isset($_SESSION['id_user'])){
    $logado = 1; 
}else{
    session_start();

    if(!isset($_SESSION['id_user']) || !isset($_GET['id_receita'])){
        header('Location: home.php');
        die();
    }
}



?>

<?php 
include 'topo.php';

// include "src/conexao.php";


$receita = new Receita();

$receita->selectReceitaId($_GET['id_receita']);
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

    .checked {
      color: orange;
    }

    .favorito{
        color: red;
    }
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container-fluid" style="padding: 45px;">

    <div class="card">
        <!-- Card content -->
        <div class="card-body">
            <!--Carousel Wrapper-->
            <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
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
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Próximo</span>
                </a>
                <!--/.Controls-->
            </div>
            <br>
            <!-- Title -->
            <div class="row">

                <div class="col-sm-4">
                    <h4 class="card-title"><a style="font-size: 28px; "><?php echo $receita->getTitulo(); ?></a></h4>
                </div>

                <div class="col-sm-2 col-6">
                    <h6 class="font-weight-bold indigo-text py-2" style="padding-top: 0px!important;"> <i class="far fa-clock"></i> <?php echo number_format($receita->getTempo_preparo(), 2, ':', ''); ?></h6>
                </div>

                <div class="col-sm-2 col-6">
                    <?php 

                        for ($i=1; $i <= 5 ; $i++) { 
                            ?>
                            <span class="fa fa-star checked" value="<?php echo($i) ?>"></span>
                            <?php
                        }
                    ?>

                </div>

                <div class="col-sm-2 col-6" align="center">
                    <span class="fa fa-heart favorito" value="<?php echo($receita->getId()); ?>" style="font-size: 26px;"></span>
                </div>

                <div class="col-md-2 col-6">
                    <?php 
                        $pais = new Pais();
                        $aux = $pais->executeQuery("SELECT `pais`.* FROM `pais` INNER JOIN `receita` ON `pais`.`id` = `receita`.`pais` WHERE `receita`.`id` = ".$receita->getId());

                        if(count($aux)){
                            ?>
                            <a href="#" style="font-size: 16px; font-weight: bold; color: #000;">
                                <img src="<?php echo($aux[0]->getPath_icon()); ?>" width="30">
                                <?php echo $aux[0]->getNome(); ?>
                            </a>
                            <?php
                        }
                    ?>
                </div>
                <div class="col-sm-12" align="center">
                    <a href="#adicionar-foto" class="btn btn-success" data-toggle="modal" data-target="#adicionar-foto">Adicionar Foto</a>
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
                <div class="col-sm-12 destaque" style="padding-left: 5%">
                    <?php 

                        echo $receita->getModo_preparo();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade top" id="adicionar-foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria="true" data-backdrop="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Coloque sua Receita Aqui !</p>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="row d-flex justify-content-center align-items-center" align="center">
                    <form action="control/images.php" enctype="multipart/form-data" method="POST">
                        <input type="text" name="id-receita" style="display: none;" value="<?php echo($receita->getId()); ?>">

                        <div class="form-group custom-file">
                            <input type="file" class="custom-file-input" id="adicionar-foto" name="adicionar-foto" accept="image/*">
                            <label class="custom-file-label" for="adicionar-foto" data-browse="Galeria">
                                Selecione seu Arquivo
                            </label>
                        </div>

                        <div class="form-group" style="margin-top: 15px;">
                            <button type="submit" class="btn btn-success">
                                Enviar
                            </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<?php
include 'rodape.php';
?>

<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>


</script>
