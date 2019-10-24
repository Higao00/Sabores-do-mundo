<?php
error_reporting(0);
ini_set(“display_errors”, 0 );

require 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
	.checked {
	  color: orange!important;
	}

	 @media only screen and (max-width: 450px) {
        main{
            padding-top: 15%!important;
            padding-bottom: 5%!important;
        }
    }
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container">
	<?php 

		$receita = new Receita();
		$aux = $receita->executeQuery('SELECT * FROM `receita` ORDER BY `receita`.`id` DESC LIMIT 30');
		monta_lista_receita($aux);
	?>
</div>

<?php
require 'rodape.php';
?>

<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>

	$(document).ready(function(){
		$('a[href="home.php"]').addClass('active');
	});
</script>
