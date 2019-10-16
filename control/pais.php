<?php 

	include '../src/conexao.php';
	include '../src/Pais.php';
	include "../src/Util.php";
	include "../src/SimpleImage.php";

	session_start();

	if(isset($_POST['action'])){

		switch ($_POST['action']) {
			case 'Remove':
				$pais = new Pais();

				$pais->selectPaisId($_POST["id-pais"]);
				$pais->executeQuery('DELETE FROM `pais` WHERE `id` = '.$pais->getId());

				unlink('../'.$pais->getPath_icon());

				$_SESSION['msg'] = "Sucesso ao Excluir o Pais!";

				header('Location: ../cad_pais.php?status=1');
				die();

				break;

			case 'Salvar':

				$image_name = uniqid().".jpg";
				$imgObj = new Image();

				$img = new SimpleImage($_FILES['icone_pais']['tmp_name']);

				$img->resize(128, 128);
				$img->toFile('../images/icon-pais/'.$image_name);
				$path = 'images/icon-pais/'.$image_name;

				if(isset($_POST['id-pais']) && $_POST['id-pais'] != -1 ){
					$pais = new Pais();
					$pais->selectPaisId($_POST["id-pais"]);

					$pais->setNome($_POST['pais']);
					$pais->setLocalidade($_POST['localidade']);
					$pais->setPath_icon($path);

					$pais->updatePais();
				}else{

					$pais = new Pais('',$_POST['pais'], $_POST['localidade'], $path);
					$pais->insertPais();

				}

				$_SESSION['msg'] = "Sucesso ao Cadastrar o Pais!";

				header('Location: ../cad_pais.php?status=1');
				die();

				break;
			
			default:
				header('Location: ../cad_pais.php?');
				die();

				break;
		}
	}
	
?>