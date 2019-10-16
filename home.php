<?php
error_reporting(0);
ini_set(“display_errors”, 0 );

require 'topo.php';
?>

<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>

</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<div class="container">

<?php 
	isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = 0;
?>
<div class="row" style="margin-top: 50px;">
	<form class="form" action="control/notificacao.php" method="POST">
		<input type="text" name="id_user" style="display: none;" value="<?php echo($user);  ?>">
		<div class="form-group">
			<label>Digite a mensagem</label>
			<input type="text" class="form-control" name="msg">
		</div>

		<button type="submit" class="btn btn-succes" name="send_notification">Enviar</button>
	</form>
</div>

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
