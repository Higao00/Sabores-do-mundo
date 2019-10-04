<?php
include("conexao.php");
include("Usuario.php");
include("Avaliacao.php");
include("Categoria.php");

//$usuario = new Usuario();

//$usuario->setNome("José");
//$usuario->setEmail("João@joão.com");
//$usuario->setNascimento("20-11-1998");
//$usuario->setSenha("1234");

//$avaliacao = new Avaliacao('',1, 5, 15);
//$avaliacao->selectAvaliacaoId($avaliacao->insertAvaliacao());

//$aux = $avaliacao->executeQuery("SELECT * FROM avaliacao WHERE id >= 4");

$categoria = new Categoria();

echo '<pre>';
print_r($categoria);
echo '</pre>';


$categoria->selectCategoriaId(100);

echo '<pre>';
print_r($categoria);
echo '</pre>';
?>


