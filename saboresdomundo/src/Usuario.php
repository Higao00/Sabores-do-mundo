<?php

include('conexao.php');

class Usuario {

    private $id;
    public $nome;
    public $nascimento;
    private $email;
    private $senha;
    private $timestamp;

    function __construct($nome = '', $nascimento = '', $email = '', $senha = '') {
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->email = $email;
        $this->senha = $senha;
    }

    function getNome() {
        return utf8_encode($this->nome);
    }

    function getID() {
        return $this->id;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    function getEmail() {
        return utf8_encode($this->email);
    }

    function getSenha() {
        return utf8_encode($this->senha);
    }

    function getTimestamp() {
        return utf8_encode($this->timestamp);
    }

    function setNome($nome) {
        $this->nome = utf8_decode($nome);
    }

    function setNascimento($nascimento) {
        $this->nascimento = utf8_decode($nascimento);
    }

    function setEmail($email) {
        $this->email = utf8_decode($email);
    }

    function setSenha($senha) {
        $this->senha = utf8_decode($senha);
    }

    function setID($id) {
        $this->id = $id;
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
        } catch (Exception $ex) {
            var_dump($ex);
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
                    
                    $aux = new Usuario($value->nome, $value->nascimento, $value->email, $value->senha);
                    $aux->setID($value->id);
                    $aux->setTimestamp($value->changelog);
                    $Usuarios[] = $aux;
                }
            }
            return $Usuarios;
        } catch (Exception $ex) {
            //var_dump($ex);
        }
    }
}

?>