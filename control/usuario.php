
<?php
	
    include("../src/conexao.php");
    include("../src/usuario.php");

    if(isset($_POST['cadastro-usuario'])){

        //var_dump($_POST);

        if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['date-nascimento'])){
            $senha = md5($_POST['senha']);
            $nome = utf8_decode($_POST['nome']);

            $usuario = new Usuario('',$nome, $_POST['date-nascimento'], $_POST['email'], $senha);  

            $usuario->insertUser();
                
            //echo $_SERVER['HTTP_REFERER'].'status=1';
            header('Location: '.$_SERVER['HTTP_REFERER'].'status=1');
            die();
        }else{
            //echo $_SERVER['HTTP_REFERER'].'status=0';
            header('Location: '.$_SERVER['HTTP_REFERER'].'status=0');
            die();
        }
    }

?>