<?php 

	include '../src/conexao.php';
	include '../src/Categoria.php';
	include "../src/Util.php";
	include "../src/SimpleImage.php";

	session_start();

	if(isset($_POST['action'])){

		switch ($_POST['action']) {
			case 'Remove':
				$categoria = new Categoria();

				$categoria->selectCategoriaId($_POST["id-categoria"]);
				$categoria->executeQuery('DELETE FROM `categoria` WHERE `id` = '.$categoria->getId());

				unlink('../'.$categoria->getPath_icon());

				$_SESSION['msg'] = "Sucesso ao Excluir a Categoria!";

				header('Location: ../cad_categoria.php?status=1');
				die();

				break;

			case 'Salvar':

				$image_name = uniqid().".jpg";
				$imgObj = new Image();

				$img = new SimpleImage($_FILES['icone_categoria']['tmp_name']);

				$img->resize(128, 128);
				$img->toFile('../images/icon-categoria/'.$image_name);
				$path = 'images/icon-categoria/'.$image_name;

				if(isset($_POST['id-categoria']) && $_POST['id-categoria'] != -1 ){
					$categoria = new Categoria();
					$categoria->selectCategoriaId($_POST["id-categoria"]);

					$categoria->setTitulo($_POST['nome']);
					$categoria->setPath_icon($path);

					$categoria->updateCategoria();
				}else{

					$categoria = new Categoria('',$_POST['nome'], $path);
					$categoria->insertCategoria();

				}

				$_SESSION['msg'] = "Sucesso ao Cadastrar a Categoria!";

				header('Location: ../cad_categoria.php?status=1');
				die();

				break;
			
			default:
				header('Location: ../cad_categoria.php?');
				die();

				break;
		}
	}
	
?>