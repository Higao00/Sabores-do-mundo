<?php 

include "../src/conexao.php";
include "../src/Util.php";

if (!empty($_FILES['foto-receita'])) {

	include '../src/FotoReceita.php'; 

	session_start();
	isset($_SESSION['id_user']) ? $user = $_SESSION['id_user'] : $user = -1;

	$upArquivo = new Upload;

	$extension = explode('.', $_FILES["foto-receita"]["name"]);
	$_FILES["foto-receita"]["name"] = md5(date('d-m-YH:i:s')).'.'.$extension[1];

	if($upArquivo->UploadArquivo($_FILES["foto-receita"], "../foto_receita/")){   

		$path = explode('../', $upArquivo->nome);
		$ftreceita = new FotoReceita('', '', $path[1], $user);
		$ftreceita->selectFotoReceitaId($ftreceita->insertFotoReceita());

		echo $ftreceita->getId();
	}
}

?>