<?php
include("Usuario.php");

$usuario = new Usuario();

//$usuario->setNome("José");
//$usuario->setEmail("João@joão.com");
//$usuario->setNascimento("20-11-1998");
//$usuario->setSenha("1234");


$aux = $usuario->executeQuery("SELECT * FROM `usuario` WHERE  `id` = 10");

echo '<pre>';
print_r($aux);
echo '</pre>';

foreach ($aux as $key => $value) {
	// $value->setNome("Nivaldo");
	$value->setNascimento("2018-11-20");
	$value->updateUser();

}

// Refiz o processo
// echo '<pre>';
// print_r($usuario);
// echo '</pre>';

$aux = $usuario->executeQuery("SELECT * FROM `usuario` WHERE  `id`  = 10");
	
echo '<pre>';
print_r($aux);
echo '</pre>';
?>


