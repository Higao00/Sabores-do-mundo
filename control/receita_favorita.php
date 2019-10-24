<?php 
	
	include "../src/conexao.php"; 
	include "../src/Usuario.php";
	include "../src/Subscribers.php";
	include "../src/ReceitaFavorita.php";
	include "../src/Util.php";

	if(isset($_POST['acao'])){

		switch ($_POST['acao']) {
			case 'favorita':
				
				$receitafav = new ReceitaFavorita();

				$receitafav->setUsuario($_POST['user']);
				$receitafav->setReceita($_POST['receita']);

				$receitafav->insertReceitaFavorita();

				echo json_encode(1);
				break;

			case 'desfavorita':
				
				$receitafav = new ReceitaFavorita();

				$receitafav->executeQuery("DELETE FROM `receita_favorita` WHERE `usuario` = ".$_POST['user']." AND `receita` = ".$_POST['receita']);
				echo json_encode(1);
				break;
			
			default:
				# code...
				break;
		}
	}elseif(isset($_POST['manda_notificacao'])){
		manda_notifica(
			"SELECT `subscribers`.* FROM `receita` INNER JOIN `subscribers` ON `receita`.`usuario` = `subscribers`.`usuario` WHERE `receita`.`id`=".$_POST['receita'], 
			"Olá Alguem acabou de Favoritar a sua receita!", 
			"Alguém adorou sua receita e a colocou na sua lista de fevoritos, venha conferir no APP !", 
			'exibe_receita.php?id_receita='.$_POST['receita']
		);
	}

?>