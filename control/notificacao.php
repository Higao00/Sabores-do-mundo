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

	}
?>