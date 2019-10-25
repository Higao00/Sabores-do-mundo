<?php 
	include "topo.php";

	if(!isset($_SESSION['id_user'])){
		header('Location: ../home.php');
		die();
	}
?>
<!-- INCLUIR OU CRIAR AQUI SEUS ESTILOS -->
<style>
	.pt-3-half {
		padding-top: 1.4rem;
	}

	#arquivo {
		background-color: #d6d6d6;
		height: 200px;
		width: 100%;
	}

	#icon_mais {
		margin-top: 5%;
		margin-left: 45%;
	}

	.fab{
		display: none!important;
	}

	p#titulo-page{
		text-align: center;
		font-size: 36px;
		font-weight: 500;
		margin-top: 35px;
	}

	.list-margin{
		margin-top: 30px;
	}

	th.text-center{
		font-size: 16px;
		font-weight: bold;
	}

	tr.hide{
		display: none;
	}

	@media only screen and (max-width: 450px) {
		main{
			padding-top: 15%!important;
		}
	}
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<!-- Card -->
<div class="container">

	<p class="page-title" id="titulo-page">CADASTRO DE RECEITA  <i class="fas fa-utensils mr-3"></i></p>

	<div style="margin-top: 30px;">
		<form action="control/images.php" id="DropZoneFiddle" class="dropzone" >
			<div class="dz-message">
				<span style="font-size: 20px; font-weight: 500;">Clique Aqui para adicionar Fotos. <i class="fas fa-cloud-upload-alt"></i></span><br>
			</div>
		</form>
	</div>

	<form class="form list-margin" action="control/receita.php" name="cad-receita" method="POST">
		<div class="card list-margin">
			<div class="card-body" align="center">
				<label style="font-size: 24px; font-weight: bold;">Titulo</label>
				<input type="text" class="form-control" required name="titulo-receita" placeholder="Digite aqui o Titulo da Receita">
			</div>
		</div>

		<div class="card list-margin">
			<div class="card-body">

				<?php 

					$pais = new Pais();
					$paises = $pais->selectAll();

					$categoria = new Categoria();
					$categorias = $categoria->selectAll();

				?>

				<div class="form-row">
					<div class="col">
						<label for="select-pais" class="label col" style="font-size: 18px; font-weight: bold;">Tempo preparo</label>
						<input type="number" required class="form-control" name="tempo-preparo" id="tempo-preparo" placeholder="Tempo em Minutos">
					</div>
				</div>

				<div class="form-row" style="margin-top: 2%;">
					<div class="col" style="margin: 0px!important;">
						<label for="select-categoria" class="label col" style="font-size: 18; font-weight: bold;">Categoria</label>
						<select class=" custom-select" required name="categoria" id="select-categoria">
							<option value="-1">Selecione</option>
							<?php 
								foreach ($categorias as $key => $value) {
									?>
									<option value="<?php echo $value->getId(); ?>">
										<?php echo $value->getTitulo(); ?>
									</option>
									<?php
								}
							?>
						</select>
					</div>

					<div class="col">
						<label for="select-pais" class="label col" style="font-size: 18px; font-weight: bold;">Pais</label>
						<select class=" custom-select" name="pais" required id="select-pais">
							<option value="-1">Selecione</option>
							<?php 
								foreach ($paises as $key => $value) {
									?>
									<option value="<?php echo $value->getId(); ?>">
										<?php echo $value->getNome(); ?>
									</option>
									<?php
								}
							?>
						</select>
					</div>
				</div>
				
			</div>
		</div>

		<div class="card list-margin">
			<div class="card-body">
				<div class="table table-editable" style="overflow:scroll;height:400px;width:100%;overflow:auto">
					<span class="table-add mb-3 mr-2">
						<a class="table-add" style="font-size: 24px; font-weight: 500; color: #000;">Adicionar Ingrediente</a>
					</span>
					<a class="table-add text-success float-right fas fa-plus fa-2x" aria-hidden="true" tabela="ingrediente"></a>

					<table class="table table-bordered table-responsive-md table-striped text-center list-margin" id="ingrediente">
						<thead>
							<tr>
								<th class="text-center">Quantidade</th>
								<th class="text-center">Medida</th>
								<th class="text-center">Ingrediente</th>
								<th class="text-center">Excluir</th>
							</tr>
						</thead>
						<tbody>
							<tr class="hide">
								<td class="pt-3-half"><input class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td class="pt-3-half"><input class="form-control" type="text" name="medida[]" placeholder="Digite Aqui a Medida"></td>
								<td class="pt-3-half"><input class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input required class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td class="pt-3-half"><input required class="form-control" type="text" name="medida[]" placeholder="Digite Aqui a Medida"></td>
								<td class="pt-3-half"><input required class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input required class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td class="pt-3-half"><input required class="form-control" type="text" name="medida[]" placeholder="Digite Aqui a Medida"></td>
								<td class="pt-3-half"><input required class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input required class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td class="pt-3-half"><input required class="form-control" type="text" name="medida[]" placeholder="Digite Aqui a Medida"></td>
								<td class="pt-3-half"><input required class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>

							

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="fotos-id" style="display: none;">
			
		</div>

		<div class="card list-margin">
			<div class="card-body">
				<div class="table table-editable" style="overflow:scroll;height:400px;width:100%;overflow:auto">
					<span class="table-add mb-3 mr-2">
						<a style="font-size: 24px; font-weight: 500; color: #000;">Modo de Preparo</a>
					</span>
					<a class="table-add text-success float-right fas fa-plus fa-2x" aria-hidden="true" tabela="modo-preparo"></a>

					<table class="table table-bordered table-responsive-md table-striped text-center" id="modo-preparo">
						<thead>
							<tr>
								<th class="text-center">Modo Preparo</th>
								<th class="text-center">Excluir</th>
							</tr>
						</thead>
						<tbody>
							<tr class="hide">
								<td class="pt-3-half"><input class="form-control" type="text" name="modo-preparo[]"  placeholder="Digite Aqui O Modo de Preparo"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input class="form-control" required type="text" name="modo-preparo[]"  placeholder="Digite Aqui O Modo de Preparo"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input class="form-control" required type="text" name="modo-preparo[]"  placeholder="Digite Aqui O Modo de Preparo"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input class="form-control" required type="text" name="modo-preparo[]"  placeholder="Digite Aqui O Modo de Preparo"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="form-group" align="right">
					<button type="submit" class="btn btn-success btn-rounded my-0">Enviar Receita</button>
				</div>
			</div>
		</div>
		
	</form>

</div>


<?php
include 'rodape.php';
?>
<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>
	Dropzone.options.DropZoneFiddle = {
	  paramName: "foto-receita", // The name that will be used to transfer the file
	  maxFilesize: 8, // MB
	  maxFiles: 5,
	  acceptedFiles:"image/*",
	  resizeWidth: 1024,
      resizeHeight: 720,
	  success: function(file, response){
	  	$('div#fotos-id').append('<input name="ft-id[]" value="'+response+'">');
	  }
	};

	$(document).ready(function() {

		$('a[href="cadastro_receita.php"]').addClass('active');

		const $tableID = $('.table');

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

	});
</script>
