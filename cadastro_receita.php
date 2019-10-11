<?php
include 'topo.php';
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
		p#titulo-page{
			margin-top: 50px;
		}
	}

	#cadastro {
		float: right;
	}
</style>

<!-- CRIAR AQUI O HTML DA SUA PAGINA -->
<!-- Card -->
<div class="container">
	<<<<<<< HEAD

	<p class="page-title" id="titulo-page">CADASTRO DE RECEITA  <i class="fas fa-utensils mr-3"></i></p>

	<div id="dropzone" style="margin-top: 30px;">
		<form action="control/receita.php" class="dropzone needsclick" >
			<div class="dz-message needsclick">
				<span style="font-size: 20px; font-weight: 500;">Clique Aqui para adicionar Fotos. <i class="fas fa-cloud-upload-alt"></i></span><br>
			</div>
		</form>
	</div>

	<form class="form list-margin" action="control/receita.php" name="cad-receita" method="POST">
		<div class="card list-margin">
			<div class="card-body" align="center">
				<label style="font-size: 24px; font-weight: bold;">Titulo</label>
				<input type="text" class="form-control" name="titulo-receita" placeholder="Digite aqui o Titulo da Receita">
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
								<th class="text-center">Ingrediente</th>
								<th class="text-center">Quantidade</th>
								<th class="text-center">Excluir</th>
							</tr>
						</thead>
						<tbody>
							<tr class="hide">
								<td class="pt-3-half"><input class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td class="pt-3-half"><input class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input required class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td class="pt-3-half"><input required class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input required class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td class="pt-3-half"><input required class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>
							<tr>
								<td class="pt-3-half"><input required class="form-control" type="text" name="ingrediente[]" placeholder="Digite Aqui o Nome do Ingrediente"></td>
								<td class="pt-3-half"><input required class="form-control" type="number" name="quantidade[]" placeholder="Digite Aqui a Quantidade"></td>
								<td>
									<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
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

	=======
	<div class="row">
		<div class="col-lg-12">
			<div class="card-body ">
				<div class="card">
					<form class="text-center border border-light p-5" action="#!">
						<input type="text" id="exampleForm2" class="form-control" placeholder="Nome da Receita">
						<div class="card-body">
							<div id="table" class="table-editable" style="overflow:scroll;height:400px;width:100%;overflow:auto">
								<span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
								<table class="table table-bordered table-responsive-md table-striped text-center" id="table">
									<thead>
										<tr>
											<th class="text-center">Ingrediente</th>
											<th class="text-center">Quantidade</th>
											<th class="text-center">Excluir</th>
										</tr>
									</thead>
									<tbody>
										<tr class="hidden" id="hidden">
											<td class="pt-3-half" contenteditable="true"></td>
											<td class="pt-3-half" contenteditable="true"></td>
											<td>
												<span class="table-remove"><button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="form-group">
									<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Modo de preparo"></textarea>
								</div>
							</div>
						</div>
						<button type="button" class="btn btn-outline-success waves-effect" id="cadastro">Cadastrar</button>
					</form>
					<!-- Editable table -->
				</div>
			</div>
		</div>
	</div>
	>>>>>>> origin/master
</div>


<?php
include 'rodape.php';
?>
<!-- FAZER AQUI A INCLUSAO DE SCRIPTS OU SEUS PROPIOS SCRIPTS -->
<script>
	$(document).ready(function() {

		$('a[href="cadastro_receita.php"]').addClass('active');

		Dropzone.options.myAwesomeDropzone = {
		  paramName: "file", // The name that will be used to transfer the file
		  maxFilesize: 2, // MB

		  accept: function(file, done) {
		  	console.log(file);
		  	if (file.type != "image/jpeg") {
		  		done("Error! Files of this type are not accepted");
		  	}
		  	else { done(); }
		  }
		};
		

		const $tableID = $('.table');

		$(document).on('click', 'a.table-add', function(){

			var table = $(this).attr('tabela');
			var tabela = $('table#'+table);

			var $clone = tabela.find('> tbody > tr.hide').clone(true).removeClass('hide');

			tabela.find('input').each(function(){
				$(this).attr('required', 'true');
			});

			tabela.find('> tbody').append($clone);
		});

		$tableID.on('click', '.table-remove', function() {
			$(this).parents('tr').detach();
		});

	});
</script>
