</main>

<!-- Botao Flutuante -->

<div class="fab">
	<button class="main" onclick="location.href='cadastro_receita.php'">
	</button>
</div>


<div class="modal fade" id="cadastro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria="true">
	<div class="modal-dialog form-dark" role="document">
		<!--Content-->
		<div class="modal-content card card-image" style="background-image: url('images/pagina_principal2.jpg');">
			<div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
				<!--Header-->
				<div class="modal-header text-center pb-4">
					<h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>Cadastro</strong></h3>
					<button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
						<span aria="true">&times;</span>
					</button>
				</div>
				<!--Body-->
				<div class="modal-body">
					<!--Body-->

					<form action="control/usuario.php" method="POST">
						<div class="md-form mb-5">
							<input type="text" required id="nome_cad" name="nome" class="form-control validate white-text">
							<label for="nome_cad">Nome</label>
						</div>

						<div class="md-form mb-5">
							<input type="email" required id="email_cad" name="email" class="form-control validate white-text">
							<label for="email_cad">E-mail</label>
						</div>

						<div class="md-form mb-5">
							<input type="password" required id="senha_cad" name="senha" class="form-control validate white-text">
							<label for="senha_cad">Senha</label>
						</div>

						<!--Grid row-->
						<div class="row d-flex align-items-center mb-4">

							<!--Grid column-->
							<div class="text-center mb-3 col-md-12">
								<button type="submit" class="btn btn-amber" name="cadastrar">Cadastrar</button>
							</div>
							<!--Grid column-->
						</div>
					</form>
					<!--Grid row-->
				</div>
			</div>
		</div>
		<!--/.Content-->
	</div>
</div>

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria="true">
	<div class="modal-dialog form-dark" role="document">
		<!--Content-->
		<div class="modal-content card card-image" style="background-image: url('images/pagina_principal.jpg');">
			<div class="text-white rgba-stylish-strong py-5 px-5 z-depth-4">
				<!--Header-->
				<div class="modal-header text-center pb-4">
					<h3 class="modal-title w-100 white-text font-weight-bold" id="myModalLabel"><strong>Entrar</strong></h3>
					<button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
						<span aria="true">&times;</span>
					</button>
				</div>
				<!--Body-->
				<div class="modal-body">
					<!--Body-->
					<form action="control/usuario.php" method="POST" id="login">
						<div class="md-form mb-5">
							<input type="email" id="email_login" name="email" class="form-control white-text">
							<label for="email_login">E-mail</label>
						</div>

						<div class="md-form pb-3">
							<input type="password" id="senha_login" name="senha" class="form-control white-text">
							<label for="senha_login">Senha</label>
						</div>

						<!--Grid row-->
						<div class="row d-flex align-items-center mb-4">

							<!--Grid column-->
							<div class="text-center mb-3 col-md-12">
								<button type="submit" name="login" class="btn btn-amber">Entrar</button>
							</div>
							<!--Grid column-->
						</div>
					</form>
					<!--Grid row-->
				</div>
			</div>
		</div>
		<!--/.Content-->
	</div>
</div>

<div class="modal fade " id="configuracao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria="true">
	<div class="modal-dialog modal-notify modal-info" role="document">
		<!--Content-->
		<div class="modal-content text-center">
			<!--Header-->
			<div class="modal-header d-flex justify-content-center">
				<p class="heading">Deseja Receber Notificação</p>
				<button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
					<span aria="true">&times;</span>
				</button>
			</div>

			<!--Body-->
			<div class="modal-body">
				<i class="fas fa-bell fa-4x animated rotateIn mb-4"></i>
			</div>
			<!--Footer-->

			<form action="control/notificacao.php" method="POST" id="form-notifica">
			</form>

			<div class="modal-footer flex-center">
				<input type="submit" name="action" form="form-notifica" class="btn btn-success" value="Sim">
				<input type="submit" name="action" form="form-notifica" class="btn btn-danger" value="Não">
			</div>
		</div>
		<!--/.Content-->
	</div>
</div>

<div class="modal fade " id="pais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria="true">
	<div class="modal-dialog modal-notify modal-info" role="document">
		<!--Content-->
		<div class="modal-content text-center">
			<!--Header-->
			<div class="modal-header d-flex justify-content-center">
				<p class="heading" style="font-size: 22px;">Lista de Paises</p>
				<a class="close" data-dismiss="modal" aria-label="Close" id="botao_paises">
					<span aria-hidden="true" style="color: #FFF;">&times;</span>
				</a>
			</div>

			<!--Body-->
			<div class="modal-body">
				<ul class="navbar-nav">
					<?php 

						$pais = new Pais();

						$paises = $pais->selectAll();

						foreach ($paises as $key => $value) {
							?>
							<li class="nav-item"> 
								<div class="row">
									<div class="col-sm-4" align="right">
										<img src="<?php echo($value->getPath_icon()); ?>" id="<?php echo($key) ?>" width="50">
									</div>
									<div class="col-sm-8" align="left">
										<a class="dropdown-item" href="lista_receita.php?tipo=pais&id=<?php echo($value->getId()); ?>" style="font-size: 20px; font-weight: bold;">
											<?php echo $value->getNome(); ?>

									</div>
								</div>
								</a>
							</li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
		<!--/.Content-->
	</div>
</div>

<div class="modal fade " id="categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria="true">
	<div class="modal-dialog modal-notify modal-info" role="document">
		<!--Content-->
		<div class="modal-content text-center">
			<!--Header-->
			<div class="modal-header d-flex justify-content-center">
				<p class="heading" style="font-size: 22px;">Lista de Categorias</p>
				<a class="close" data-dismiss="modal" aria-label="Close" id="botao_categoria">
					<span aria-hidden="true" style="color: #FFF;">&times;</span>
				</a>
			</div>

			<!--Body-->
			<div class="modal-body">
				<ul class="navbar-nav">
					<?php 

						$categoria = new Categoria();

						$categorias = $categoria->selectAll();

						foreach ($categorias as $key => $value) {
							?>
							<li class="nav-item"> 
								<div class="row">
									<a class="dropdown-item" href="lista_receita.php?tipo=categoria&id=<?php echo($value->getId()); ?>" style="font-size: 20px; font-weight: bold;">
										<img src="<?php echo($value->getPath_icon()); ?>" id="<?php echo($key) ?>" width="50">
										<?php echo $value->getTitulo(); ?>
									</a>
								</div>
							</li>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
		<!--/.Content-->
	</div>
</div>

<div class="modal fade top" id="sair" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria="true" data-backdrop="true">
	<div class="modal-dialog modal-notify modal-info" role="document">
		<!--Content-->
		<div class="modal-content">
			<!--Body-->
			<div class="modal-body">
				<div class="row d-flex justify-content-center align-items-center" align="center">
					<form action="control/usuario.php" method="POST">

						<p class="pt-3 pr-2" style="font-size: 18px; text-transform: uppercase; font-weight: bold; color: #000;">
							<i class="fas fa-sign-out-alt" style="color: #000!important;"></i> Deseja sair da sua conta ?</p>

						<button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">Não</button>
						<button type="submit" name="sair" class="btn btn-danger">Sim</button>
					</form>
				</div>
			</div>
		</div>
		<!--/.Content-->
	</div>
</div>

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<script src="js/sweetalert2.min.js"></script>
<script src="js/dropzone.min.js"></script>

<!-- Initializations -->
<script type="text/javascript">
	$(document).ready(function() {

		$('footer').hide();

		if ($(window).width() < 680) {
			$('form#busca_principal').addClass('col-sm-12');
		}

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

		swRegistration.pushManager.getSubscription()
		.then(function(subscription) {
		  isSubscribed = !(subscription === null);

		  if (isSubscribed) {
		  	// METODO PARA PEGAR AS CHAVES PARA AUTENTICACAO POSTERIOR
		  	var p256dh = btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('p256dh'))));
		  	var auth = btoa(String.fromCharCode.apply(null, new Uint8Array(subscription.getKey('auth'))));

		  	$('form#login > div.row').append("<input name='auth' value='"+auth+"' style='display:none;'>");
		  	$('form#login > div.row').append('<input name="p256dh" value="'+p256dh+'" style=" display:none;">');

		  	$('form#form-notifica').append("<input name='auth' value='"+auth+"' style='display:none;'>");
		  	$('form#form-notifica').append('<input name="p256dh" value="'+p256dh+'" style=" display:none;">');

		  } 		  
		  //updateBtn();
		});

	});
</script>

<script src="js/main.js"></script>

</body>

</html>