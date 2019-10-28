<?php 
	
	// error_reporting(0);
	// ini_set(“display_errors”, 0 );

	include "../src/conexao.php";
	include "../src/Receita.php";
	include '../src/FotoReceita.php'; 
	include '../src/Ingrediente.php'; 
	include '../src/IngredienteReceita.php'; 
	include '../src/ReceitaFavorita.php';
	include '../src/Avaliacao.php';
	include '../src/Util.php';
	include '../src/Subscribers.php';

	if(isset($_POST['titulo-receita']) && !empty($_POST['ft-id'])) {

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
		header('Location: ../exibe_receita.php?status=1&id_receita='.$idReceita);
		die();
	}elseif(isset($_GET['excluir-receita'])){
		session_start();
		isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;

		if($user != -1){
			$receita = new Receita();
			$receita->selectReceitaId($_GET['excluir-receita']);

			if($receita->getUsuario() == $user || $user == 1){

				//Apago os ingredientes da receita
				$ingre_receita = new IngredienteReceita();
				$ingredientes = $ingre_receita->executeQuery('SELECT * FROM `ingrediente_receita` WHERE `receita` = '.$receita->getId());
				foreach ($ingredientes as $key => $value) {
					$value->executeQuery("DELETE FROM `ingrediente_receita` WHERE `id` = ".$value->getId());
				}

				//Apago as receitas favoritas
				$receita_fav = new ReceitaFavorita();
				$receita_fav = $receita_fav->executeQuery("SELECT * FROM `receita_favorita` WHERE `receita` = ".$receita->getId());
				foreach ($receita_fav as $key => $value) {
					$value->executeQuery("DELETE FROM `receita_favorita` WHERE `id` = ".$value->getId());
				}

				//Apago as fotos das receitas
				$foto_receita = new FotoReceita();
				$foto_receita = $foto_receita->executeQuery("SELECT * FROM `foto_receita` WHERE `receita` = ".$receita->getId());
				foreach ($foto_receita as $key => $value) {
					$value->executeQuery("DELETE FROM `foto_receita` WHERE `id` = ".$value->getId());

					unlink('../'.$value->getPath_foto());
				}

				//Apago as Avaliações da Receita
				$avaliacao = new avaliacao();
				$avaliacao = $avaliacao->executeQuery('SELECT * FROM `avaliacao` WHERE `receita` = ');
				foreach ($avaliacao as $key => $value) {
					$value->executeQuery("DELETE FROM `avaliacao` WHERE `id` = ".$value->getId());
				}

				$receita->executeQuery("DELETE FROM `receita` WHERE `id` =".$receita->getId());

				$_SESSION['msg'] = 'Sucesso ao Excluir a Receita!';
				header('Location: ../home.php?status=1');
				die();

			}else{
				$_SESSION['msg'] = 'Erro ao Excluir a Receita!';
				header('Location: ../home.php?status=0');
				die();
			}

		}else{
			$_SESSION['msg'] = 'Erro ao Excluir a Receita!';
			header('Location: ../home.php?status=0');
			die();
		}
	}

	header('Location: ../home.php');
	die();

	// $receita->selectReceitaId($idReceita);
	// echo "<pre>";
	// print_r($receita);
	// echo "</pre>";

?>