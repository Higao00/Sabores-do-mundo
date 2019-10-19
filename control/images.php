<?php 

include "../src/conexao.php";
include "../src/Util.php";
include "../src/SimpleImage.php";

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

	$receita = $_POST['id-receita'];

	$image_name = uniqid().".jpg";
	$imgObj = new Image();

	$img = new SimpleImage($_FILES['adicionar-foto']['tmp_name']);

	$img->resize(720, 480);
	$img->toFile('../foto_receita/'.$image_name);

	$path = 'foto_receita/'.$image_name;
	$ftreceita = new FotoReceita('', $receita, $path, $user);
	$ftreceita->selectFotoReceitaId($ftreceita->insertFotoReceita());

	$_SESSION['msg'] = 'Foto cadastrada com Sucesso!';

	header('Location: ../exibe_receita.php?id_receita='.$_POST['id-receita'].'&status=1');
	die();
}

?>