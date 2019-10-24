<?php 

include "../src/conexao.php";
include "../src/Util.php";
include "../src/SimpleImage.php";
include "../src/Usuario.php";
include "../src/Subscribers.php";

// var_dump($_POST);
// var_dump($_FILES);
// die();

if (!empty($_FILES['foto-receita'])) {

	include '../src/FotoReceita.php'; 

	session_start();
	isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;

	$image_name = uniqid().".jpg";
	$imgObj = new Image();

	$img = new SimpleImage($_FILES['foto-receita']['tmp_name']);

	$img->resize(720, 480);
	$img->toFile('../foto_receita/'.$image_name);

	$path = 'foto_receita/'.$image_name;
	$ftreceita = new FotoReceita('', '', $path, $user);
	$ftreceita->selectFotoReceitaId($ftreceita->insertFotoReceita());

	echo $ftreceita->getId();
}else if(!empty($_FILES['adicionar-foto'])){
	include '../src/FotoReceita.php'; 

	session_start();
	isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;

	$current_user = new Usuario();
	$current_user->selectUserId($_SESSION['id_user']);
	$current_name = explode(' ', $current_user->getNome());

	$receita = $_POST['id-receita'];

	$image_name = uniqid().".jpg";
	$imgObj = new Image();

	$img = new SimpleImage($_FILES['adicionar-foto']['tmp_name']);

	$img->resize(720, 480);
	$img->toFile('../foto_receita/'.$image_name);

	$path = 'foto_receita/'.$image_name;
	$ftreceita = new FotoReceita('', $receita, $path, $user);
	$ftreceita->selectFotoReceitaId($ftreceita->insertFotoReceita());

	manda_notifica("SELECT * FROM `subscribers` WHERE usuario =".$ftreceita->getUsuario(), "Olá, tem foto nova na sua receita!", $current_name[0]." acabou de postar uma foto na sua receita, venha conferir no APP!", 'exibe_receita.php?id_receita='.$receita);

	$_SESSION['msg'] = 'Foto cadastrada com Sucesso!';

	header('Location: ../exibe_receita.php?id_receita='.$_POST['id-receita'].'&status=1');
	die();
}

?>