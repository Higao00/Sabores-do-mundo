<?php 
	
	require("../src/conexao.php");
	require("../src/Subscribers.php");
	include('../src/Util.php');


	if(isset($_POST['axn']) && $_POST['axn'] == 'subscribe' ){

		if(!isset($_SESSION)){
			session_start();
		}

		if(isset($_POST['endpoint']) && isset($_POST['key']) && isset($_POST['token'])){

			isset($_SESSION['id_user']) ? $usuario = $_SESSION['id_user'] : $usuario = 0;

			$notificacao = new Subscribers('', $_POST['endpoint'], $_POST['token'], $_POST['key'], $usuario, 1);

			$notificacao->insertSubscribers();
		}
	}
	else if(isset($_POST['action'])  && isset($_POST['auth']) && isset($_POST['p256dh'])){
		session_start();
		switch ($_POST['action']) {
			case 'Sim':

				$inscrito = new Subscribers('', '', $_POST['auth'], $_POST['p256dh']);

				$aux_inscrito = $inscrito->executeQuery("SELECT * FROM `subscribers` WHERE `p256dh` = '".$inscrito->getP256dh()."' AND `auth` = '".$inscrito->getAuth()."' ");

				if(count($aux_inscrito)){
					if ( $aux_inscrito[0]->getStatus() != 1) {
						$aux_inscrito[0]->setStatus('1');
						$aux_inscrito[0]->updateSubscribers();
					}
				}
				$_SESSION['msg'] = 'Notificações Habilitadas com Sucesso!';
				header('Location: ../home.php?status=1');
				die();

				break;

			case 'Não':
				$inscrito = new Subscribers('', '', $_POST['auth'], $_POST['p256dh']);

				$aux_inscrito = $inscrito->executeQuery("SELECT * FROM `subscribers` WHERE `p256dh` = '".$inscrito->getP256dh()."' AND `auth` = '".$inscrito->getAuth()."' ");

				if(count($aux_inscrito)){

					if ( $aux_inscrito[0]->getStatus() != 0) {
						$aux_inscrito[0]->setStatus('0');
						$aux_inscrito[0]->updateSubscribers();
					}
				}
				$_SESSION['msg'] = 'Notificações desabilitadas com Sucesso!';
				header('Location: ../home.php?status=1');
				die();

				break;
			
			default:
				header('Location: ../home.php');
				die();
				break;
		}
	}
	elseif(isset($_POST['send_notification']) && isset($_POST['msg'])){

		$notificacao = new Subscribers();
		$aux = $notificacao->executeQuery("SELECT * FROM `subscribers` ");

		$notificacoes = [];
		$notifica_linha;

		foreach ($aux as $key => $value) {

			$dado = '';
			$dado['titulo'] = $_POST['msg'];
			$dado['msg'] = $_POST['msg'];
			$dado['icon'] = 'http://saboresdomundo.tech/saboresdomundo/images/icons/icon-512x512.png';
			$dado['link_red'] = 'http://descomplicasms.com';

			$notifica_linha['dados'] = $dado;

			$notifica_linha['auth']['endpoint'] = $value->getEndpoint();
			$notifica_linha['auth']['p256dh'] = $value->getP256dh();
			$notifica_linha['auth']['auth'] = $value->getAuth();

			$notificacoes[] = $notifica_linha;
		}

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, 'https://notificacao.ibsystem.com.br/demosite/get_notification.php');
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt($curl, CURLOPT_POSTFIELDS, 
		http_build_query($notificacoes));

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($curl);

		$aux = curl_getinfo($curl);
		curl_close($curl);

		header('Location: ../index.php?status=1');
		die();
	}

	header('Location: ../home.php');
	die();
?>