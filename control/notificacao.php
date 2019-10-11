<?php 
	
	require("../src/conexao.php");
	require("../src/Subscribers.php");


	if(isset($_POST['axn']) && $_POST['axn'] == 'subscribe' ){

		if(!isset($_SESSION)){
			session_start();
		}

		if(isset($_POST['endpoint']) && isset($_POST['key']) && isset($_POST['token'])){

			isset($_SESSION['id_user']) ? $usuario = $_SESSION['id_user'] : $usuario = 0;

			$notificacao = new Subscribers('', $_POST['endpoint'], $_POST['token'], $_POST['key'], $usuario, 1);

			$notificacao->insertSubscribers();
		}

	}elseif(isset($_POST['axn']) && $_POST['axn'] == 'unsubscribe' ){

	}elseif(isset($_POST['send_notification']) && isset($_POST['msg'])){

		include('../envia_notificacao.php');

		$notificacao = new Subscribers();
		$aux = $notificacao->executeQuery("SELECT * FROM `subscribers` ");

		$notificacoes = [];
		$notifica_linha;

		foreach ($aux as $key => $value) {

			$dado = '';
			$dado['id_user'] = $_POST['id_user'];
			$dado['titulo'] = $_POST['msg'];
			$dado['msg'] = $_POST['msg'];
			$dado['icon'] = 'http://descomplicasms.com/SaboresDoMundo/images/icons/icon-512x512.png';
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
?>