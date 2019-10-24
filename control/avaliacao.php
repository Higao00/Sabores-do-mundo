<?php 
	
	include "../src/conexao.php"; 
	include "../src/Usuario.php";
	include "../src/Subscribers.php";
	include "../src/Avaliacao.php";
	include "../src/Util.php";

	if(isset($_POST['avalia_receita'])){

		$avaliacao = new Avaliacao();

		$aux_avaliacao = $avaliacao->executeQuery('SELECT * FROM `avaliacao` WHERE `usuario` = '.$_POST['user'].' AND `receita` = '.$_POST['receita']);

		if(count($aux_avaliacao) == 0){
			// Crio uma nova Avaliacao
			$avaliacao->setReceita($_POST['receita']);
			$avaliacao->setUsuario($_POST['user']);
			$avaliacao->setAvaliacao($_POST['valor']);

			$avaliacao->insertAvaliacao();

			// manda_notifica("SELECT subscribers.* FROM `receita` INNER JOIN `usuario` ON `receita`.`usuario` = `usuario`.`id` INNER JOIN `subscribers` ON `usuario`.`id` = `subscribers`.`usuario` WHERE `receita`.`id` = ".$_POST['receita'], "Olá Alguem acabou de avaliar a sua receita!", "Alguem acabou de dar nota ".$_POST['valor']." na sua receita, venha conferir no APP !", 'exibe_receita.php?id_receita='.$_POST['receita']);

			echo json_encode(1);
		}else if($aux_avaliacao[0]->getAvaliacao() != $_POST['valor']){
			$aux_avaliacao[0]->setAvaliacao($_POST['valor']);

			$aux_avaliacao[0]->updateAvaliacao();

			// manda_notifica("SELECT subscribers.* FROM `receita` INNER JOIN `usuario` ON `receita`.`usuario` = `usuario`.`id` INNER JOIN `subscribers` ON `usuario`.`id` = `subscribers`.`usuario` WHERE `receita`.`id` = ".$_POST['receita'], "Olá Alguem acabou de avaliar a sua receita!", "Alguem acabou de dar nota ".$_POST['valor']." na sua receita, venha conferir no APP !", 'exibe_receita.php?id_receita='.$_POST['receita']);

			echo json_encode(1);

		}
	}elseif(isset($_POST['manda_notificacao'])){
		manda_notifica(
			"SELECT subscribers.* FROM `receita` INNER JOIN `usuario` ON `receita`.`usuario` = `usuario`.`id` INNER JOIN `subscribers` ON `usuario`.`id` = `subscribers`.`usuario` 
			WHERE `receita`.`id` = ".$_POST['receita'], 
			"Olá Alguem acabou de avaliar a sua receita!", 
			"Alguem acabou de dar nota ".$_POST['valor']." na sua receita, venha conferir no APP !", 
			'exibe_receita.php?id_receita='.$_POST['receita']
		);
	}


?>