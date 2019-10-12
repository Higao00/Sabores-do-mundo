<?php 
	
	include "../src/conexao.php";
	include "../src/Receita.php";
	include '../src/FotoReceita.php'; 
	include '../src/Ingrediente.php'; 
	include '../src/IngredienteReceita.php'; 

	if(isset($_POST['titulo-receita'])) {

		session_start();
		isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;
		
		$titulo = $_POST['titulo-receita'];
		$ingreceita = [];

		foreach ($_POST['quantidade'] as $key => $value) {
			
			if($key > 0){
				$ingrediente = new Ingrediente();

				$ingrediente->setNome($_POST['ingrediente'][$key]);
				$ingrediente->setMedida($_POST['medida'][$key]);

				$aux = $ingrediente->executeQuery("SELECT * FROM `ingrediente` WHERE `nome` = '".$ingrediente->getNome()."' AND `medida` = '".$ingrediente->getMedida()."'");

				if(count($aux) > 0){
					$ingrediente->selectIngredienteId($aux[0]->getId());
				}else{
					$ingrediente->selectIngredienteId($ingrediente->insertIngrediente());
				}

				$ingredienteReceitaeceita = new IngredienteReceita('', $ingrediente->getId(), $_POST['quantidade'][$key]);

				$ingreceita[] = $ingredienteReceitaeceita;
			}
		}

		$modoPreparo = '';

		foreach ($_POST['modo-preparo'] as $key => $value) {
			$modoPreparo += $value;
		}

		$receita = new Receita('', $_POST['titulo-receita'], $modoPreparo, $user);

		$idReceita = $receita->insertReceita();

		foreach ($ingreceita as $key => $value) {
			$value->setReceita($idReceita);
			$value->insertIngredienteReceita();
		}
	}

	$receita->selectReceitaId($idReceita);
	echo "<pre>";
	print_r($receita);
	echo "</pre>";

?>