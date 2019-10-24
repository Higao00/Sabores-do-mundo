<?php

// error_reporting(0);
// ini_set(“display_errors”, 0 );

if(isset($_SESSION['id_user'])){
    $logado = 1; 
}else{
    $logado = 0; 
    session_start();
}


?>

<?php 
include 'topo.php';

if(isset($_SESSION['id_user'])){
    $current_user = new Usuario();
    $current_user->selectUserId($_SESSION['id_user']);
}

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

    .fa-star:hover{
        cursor: pointer;
    }

    .fa-heart:hover{
        cursor: pointer;
    }
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container">

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

                        if(isset($_SESSION['id_user'])){
                            $avaliacao = new Avaliacao();
                            $avaliacoes = $avaliacao->executeQuery("SELECT * FROM `avaliacao` WHERE `usuario` = ".$current_user->getId()." AND `receita` = ".$receita->getId());

                            if(count($avaliacoes)){
                                for ($i=1; $i <= 5 ; $i++) { 

                                    if($i <= $avaliacoes[0]->getAvaliacao()){
                                        ?>
                                        <span class="fa fa-star checked" value="<?php echo($i) ?>"></span>
                                        <?php
                                    }else{
                                        ?>
                                        <span class="fa fa-star" value="<?php echo($i) ?>"></span>
                                        <?php
                                    }
                                }
                            }else{
                                for ($i=1; $i <= 5 ; $i++) { 
                                   ?>
                                   <span class="fa fa-star" value="<?php echo($i) ?>"></span>
                                   <?php
                                }
                            }
                        }
                    ?>

                </div>


                    <?php 

                        if(isset($_SESSION['id_user'])){
                            ?>
                                <div class="col-sm-2 col-6" align="center">
                            <?php

                            $receitafav = new ReceitaFavorita();
                            $aux_receitafav = $receitafav->executeQuery("SELECT * FROM `receita_favorita` WHERE `receita` =".$receita->getId()." AND `usuario`= ".$_SESSION['id_user']);

                            if(count($aux_receitafav)){
                                ?>
                                    <span class="fa fa-heart favorito" value="<?php echo($receita->getId()); ?>" style="font-size: 26px;"></span>
                                <?php
                            }else{
                                ?>
                                    <span class="fa fa-heart" value="<?php echo($receita->getId()); ?>" style="font-size: 26px;"></span>
                                <?php
                            }
                            ?>
                                </div>
                            <?php
                        }

                    ?>

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

    $(document).ready(function(){

        <?php 
            if(isset($_SESSION['id_user'])){

                echo 'var user = '.$_SESSION['id_user'].',';
                echo "receita = ".$receita->getId().';';
            ?>

            $('.fa-star').click(function(){
                
                let valor = $(this).attr('value');

                //limpo as estrelas
                $('span.fa-star').each(function(){
                    $(this).removeClass('checked');
                });

                $.ajax({  
                    url:'control/avaliacao.php',  
                    method:'POST', 
                    data: {user:user, receita:receita, valor:valor, avalia_receita:1},
                    dataType:'json',  
                    success: dados =>   
                    {   
                       Swal.fire(
                            'Sucesso ao Gravar a Avaliação !',
                            '',
                            'success'
                        );

                       $('span.fa-star').each(function(i){
                            if(i < valor){
                                $(this).addClass('checked');
                            }
                       });
                    },
                    error: erro => {
                        Swal.fire(
                            'Erro ao Gravar a Avaliação!',
                            '',
                            'error'
                        );
                    }  
                });

                $.ajax({  
                    url:'control/avaliacao.php',  
                    method:'POST', 
                    data: {user:user, receita:receita, valor:valor, manda_notificacao:1},
                });
            });

            $('span.fa-heart').click(function(){

                var acao ='';
                $('span.fa-heart').hasClass('favorito') ? acao = 'desfavorita' : acao = 'favorita';

                console.log(acao);

                $.ajax({  
                    url:'control/receita_favorita.php',  
                    method:'POST', 
                    data: {user:user, receita:receita, acao:acao},
                    dataType:'json',  
                    success: dados =>   
                    {   
                      if(acao == 'favorita'){
                        $('span.fa-heart').addClass('favorito');

                        Swal.fire(
                             'Sucesso ao Favoritar a Receita!',
                             '',
                             'success'
                         );

                        $.ajax({  
                            url:'control/receita_favorita.php',  
                            method:'POST', 
                            data: {user:user, receita:receita, manda_notificacao:1},
                        });

                      }else{
                        Swal.fire(
                             'Sucesso ao Desfavoritar a Receita!',
                             '',
                             'success'
                         ); 

                        $('span.fa-heart').removeClass('favorito');
                      }
                    },
                    error: erro => {
                        Swal.fire(
                            'Erro ao Favoritar a Receita!',
                            '',
                            'error'
                        );
                    }  
                });
            });

            <?php
            }
        ?>

    });


</script>
