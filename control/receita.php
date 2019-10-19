<?php 
	
	include "../src/conexao.php";
	include "../src/Receita.php";
	include '../src/FotoReceita.php'; 
	include '../src/Ingrediente.php'; 
	include '../src/IngredienteReceita.php'; 
	include '../src/Util.php';
	include '../src/Subscribers.php';

	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	// die();

	if(isset($_POST['titulo-receita'])) {

		session_start();
		isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;
		
		$titulo = $_POST['titulo-receita'];
		$ingreceita = [];

		//Foreach para montar os ingredientes
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
		//Foreach para montar o modo de preparo
		foreach ($_POST['modo-preparo'] as $key => $value) {
			if ($key > 0) {
				$modoPreparo .= '<br><b>'.($key).'</b>  -  '.$value;
			}
		}

		$receita = new Receita('', $_POST['titulo-receita'], $modoPreparo, $user, $_POST['categoria'], $_POST['pais'], $_POST{'tempo-preparo'});

		$idReceita = $receita->insertReceita();

		//Foreach para montar as fotos da receita
		foreach ($_POST['ft-id'] as $key => $value) {

			$ft_receita = new FotoReceita();
			$ft_receita->selectFotoReceitaId($value);

			$ft_receita->setReceita($idReceita);
			$ft_receita->updateFotoReceita();
		}

		foreach ($ingreceita as $key => $value) {
			$value->setReceita($idReceita);
			$value->insertIngredienteReceita();
		}

		manda_notifica("SELECT * FROM `subscribers`", "Tem receita Fresquinha no Aplicativo !", "Venha ver a mais nova receita cadastrada no APP !", 'exibe_receita.php?id_receita='.$idReceita);

		$_SESSION['msg'] = 'Sucesso ao Cadastrar Receita!';
		header('Location: ../exibe_receita.php?id_receita='.$idReceita);
		die();
	}

	// $receita->selectReceitaId($idReceita);
	// echo "<pre>";
	// print_r($receita);
	// echo "</pre>";

?>