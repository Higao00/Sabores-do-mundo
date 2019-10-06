
<?php
	
    include("../src/conexao.php");
    include("../src/usuario.php");

    // var_dump($_POST);
    // die();

    if(isset($_POST['cadastrar'])){

    	//Rotina para fazer o cadastro de um usuario e iniciar a sua sessão
        if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])){

        	$_POST['senha'] = utf8_decode($_POST['senha']);

            $senha = md5($_POST['senha']);
            $nome = utf8_decode($_POST['nome']);
            $email = utf8_decode($_POST['email']);

            $user_aux = new Usuario();

            $aux = $user_aux->executeQuery("SELECT * FROM `usuario` WHERE `email` = '$email'");

            if(count($aux) == 0){
                $usuario = new Usuario('',$nome, '', $email, $senha);  

                $usuario->insertUser();
                // $usuario->selectUserId($usuario->getId());

                if(!empty($_SESSION)){
                    session_destroy();
                    session_start();

                    $today = date('d-m-Y h:i:s');

                    $_SESSION['id_user'] = $usuario->getId();
                    $_SESSION['login'] = $today;
                }else{
                    session_destroy();
                    session_start();

                    $today = date('d-m-Y h:i:s');

                    $_SESSION['id_user'] = $usuario->getId();
                    $_SESSION['login'] = $today;
                }

                //echo $_SERVER['HTTP_REFERER'].'status=1';
                $_SESSION['msg'] = 'Usuario Cadastrado com Sucesso!';
                header('Location: ../index.php?status=1');
                die();
            }else{
                session_destroy();
                session_start();

                $_SESSION['msg'] = 'Usuario já Cadastrado!';
                header('Location: ../index.php?status=0');
                die();
            }
            
        }else{
            header('Location: ../index.php');
            die();
        }
    }elseif(isset($_POST['sair'])){

    	session_start();

    	if(isset($_SESSION['id_user'])){
	    	session_destroy(); 
    	}

        //echo $_SERVER['HTTP_REFERER'].'status=0';
        header('Location: ../index.php');
        die();
    }elseif(isset($_POST['login'])){

    	if(isset($_POST['email']) && isset($_POST['senha'])){

    		$_POST['senha'] = utf8_decode($_POST['senha']);

    	    $senha = md5($_POST['senha']);
    	    $email = utf8_decode($_POST['email']);

    	    $usuario = new Usuario();  

    	    $aux = $usuario->executeQuery("SELECT * FROM `usuario` WHERE `email` = '$email' AND `senha` = '$senha'");

    	    if(count($aux) > 0){

    	    	$usuario = $aux[0];

    	    	if(!empty($_SESSION)){	

    	    		session_destroy(); 
    	    		session_start();

    	    		$today = date('d-m-Y h:i:s');

    	    		$_SESSION['id_user'] = $usuario->getId();
    	    		$_SESSION['login'] = $today;
    	    	}else{
                    session_destroy(); 
    	    		session_start();

    	    		$today = date('d-m-Y h:i:s');

    	    		$_SESSION['id_user'] = $usuario->getId();
    	    		$_SESSION['login'] = $today;
    	    	}

    	    	header('Location: ../index.php');
    	    	die();
    	    }else{
                session_destroy(); 
                session_start();

    	    	$_SESSION['msg'] = 'E-mail ou Senha invalido!';

    	    	header('Location: ../index.php?status=0');
    	    	die();
    	    }
    	}
    }elseif(isset($_POST['update-usuario'])){

        session_start();

        //Rotina para fazer o Update de um usuario e iniciar a sua sessão
        if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['id_user'])){

            $_POST['senha'] = utf8_decode($_POST['senha']);

            $senha = md5($_POST['senha']);
            $nome = utf8_decode($_POST['nome']);
            $email = utf8_decode($_POST['email']);
            $id = $_POST['id_user'];
            
            isset($_POST['data-nascimento']) ? $data_nasc = $_POST['data-nascimento'] : $data_nasc = '';

            $user = new Usuario();

            $user->selectUserId($id);

            if($user->getId() == $id){
                
                $user->setNome($nome);
                $user->setEmail($email);
                $user->setNascimento($data_nasc);
                $user->setSenha($senha);

                $user->updateUser();

                //echo $_SERVER['HTTP_REFERER'].'status=1';
                $_SESSION['msg'] = 'Usuario Atualizado com Sucesso!';
                header('Location: ../perfil.php?status=1');
                die();
            }else{

                $_SESSION['msg'] = 'Erro ao atualizar o Usuario!';
                header('Location: ../perfil.php?status=0');
                die();
            }
            
        }  
    }

?>