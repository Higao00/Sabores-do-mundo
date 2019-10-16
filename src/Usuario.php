<?php

class Usuario {

    private $id;
    private $nome;
    private $nascimento;
    private $email;
    private $senha;
    private $timestamp;

    function __construct($id='', $nome='', $nascimento='', $email='', $senha='', $timestamp='') {
        $this->id = $id;
        $this->nome =  utf8_decode(addslashes($nome));
        $this->nascimento =  utf8_decode(addslashes($nascimento));
        $this->email =  utf8_decode(addslashes($email));
        $this->senha =  utf8_decode(addslashes($senha));
        $this->timestamp = $timestamp;
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return utf8_encode($this->nome);
    }

    function getNascimento() {
        return utf8_encode($this->nascimento);
    }

    function getEmail() {
        return utf8_encode($this->email);
    }

    function getSenha() {
        return utf8_encode($this->senha);
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome =  utf8_decode(addslashes($nome));
    }

    function setNascimento($nascimento) {
        $this->nascimento =  utf8_decode(addslashes($nascimento));
    }

    function setEmail($email) {
        $this->email =  utf8_decode(addslashes($email));
    }

    function setSenha($senha) {
        $this->senha =  utf8_decode(addslashes($senha));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    
    function insertUser() {
        if(empty($this->id)){
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `usuario`(`nome`, `nascimento`, `email`, `senha`) "
                        . "VALUES ('".$this->nome."','".$this->nascimento."','$this->email','".$this->senha."')");
                $this->id = $connect;
                
                return $connect;
            } catch (Exception $ex) {   
                //var_dump($ex);
            }
        }else{
            return false;
        }
    }
    function selectUserId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `usuario` WHERE `id` = ".$id);
            
            $this->id = $connect[0]->id;
            $this->nome = $connect[0]->nome;
            $this->nascimento = $connect[0]->nascimento;
            $this->email = $connect[0]->email;
            $this->senha = $connect[0]->senha;
            $this->timestamp = $connect[0]->changelog;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }
    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `usuario`");

            $Usuarios = [];

            foreach ($connect as $key => $value) {
                $Usuarios[] = new Usuario($value->id, $value->nome, $value->nascimento, $value->email, $value->senha);
            }
            
            return $Usuarios;
        } catch (Exception $ex) {
            var_dump($ex);
            return false;
        }
        return $Usuarios;
    }
    function updateUser() {
        $conexao = new conexao();
        $user_id = $this->id;
                
        try {
            $connect = $conexao->updateDB("UPDATE `usuario` SET `nome`= '$this->nome',`nascimento`= '$this->nascimento',`email`= '$this->email',`senha`= '$this->senha',`changelog`= '$this->timestamp' WHERE `id` = $this->id");
            
            return $connect;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }
    function executeQuery($query){
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB($query);
            
            $Usuarios = [];

            foreach ($connect as $key => $value) {
                if(isset($value->id) && isset($value->nome) && isset($value->nascimento) && isset($value->email) && isset($value->senha)){
                    $aux = new Usuario($value->id, $value->nome, $value->nascimento, $value->email, $value->senha);
                    $Usuarios[] = $aux;
                }
            }
            
            return $Usuarios;
        } catch (Exception $ex) {
            return false;
            //var_dump($ex);
        }
    }
    
    
}

?>