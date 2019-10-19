<?php

// error_reporting(0);
// ini_set(“display_errors”, 0 );

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



        if(isset($_GET['tipo'])){

            switch ($_GET['tipo']) {
                case 'self':

                    isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;
                    $receita_aux = new Receita();

                    $aux = $receita_aux->executeQuery('SELECT * FROM `receita` WHERE `usuario` = '.$user);

                    monta_lista_receita($aux);
                    break;

                case 'pais':

                    $id_pais = addslashes($_GET['id']);

                    $receita = new Receita();

                    $aux = $receita->executeQuery('SELECT `receita`.* FROM `receita` INNER JOIN `pais` ON `receita`.`pais` = `pais`.`id` WHERE `pais`.`id` = '.$id_pais);

                    monta_lista_receita($aux);
                    break;

                case 'categoria':
                    $id_categoria = addslashes($_GET['id']);

                    $receita = new Receita();

                    $aux = $receita->executeQuery('SELECT `receita`.* FROM `receita` INNER JOIN `categoria` ON `receita`.`categoria` = `categoria`.`id` WHERE `categoria`.`id` = '.$id_categoria);

                    monta_lista_receita($aux);
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        
    ?>

   
</div>

<?php
include 'rodape.php';
?>

<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>
    $(document).ready(function(){

        <?php 

            if(isset($_GET['tipo'])){
                switch ($_GET['tipo']) {
                    case 'self':
                        ?>
                        $('li#minhas-receitas').addClass('ativo');
                        <?php
                        break;
                    case 'categoria':
                        ?>
                        $('li#categoria-receita').addClass('ativo');
                        <?php
                        break;
                    case 'pais':
                        ?>
                        $('li#pais-receita').addClass('ativo');
                        <?php
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }

         ?>
        
    });
</script>

