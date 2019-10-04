<?php

class Avaliacao {

    private $id;
    private $receita;
    private $avaliacao;
    private $usuario;
    private $timestamp;

    function __construct($id = "", $receita = "", $avaliacao = "", $usuario = "", $timestamp = "") {
        $this->id = $id;
        $this->receita = $receita;
        $this->avaliacao = $avaliacao;
        $this->usuario = $usuario;
        $this->timestamp = $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getReceita() {
        return $this->receita;
    }

    function getAvaliacao() {
        return $this->avaliacao;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setReceita($receita) {
        $this->receita = addslashes($receita);
    }

    function setAvaliacao($avaliacao) {
        $this->avaliacao = addslashes($avaliacao);
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    
    function insertAvaliacao() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `avaliacao`(`receita`, `avaliacao`, `usuario`) "
                        . "VALUES ('" . $this->receita . "','" . $this->avaliacao. "','$this->usuario')");
                $this->id = $connect;
                
                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectAvaliacaoId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `avaliacao` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->receita = $connect[0]->receita;
            $this->avaliacao = $connect[0]->avaliacao;
            $this->usuario = $connect[0]->usuario;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `avaliacao`");

            $avaliacao = [];

            foreach ($connect as $key => $value) {
                $avaliacao[] = new Avaliacao($value->id, $value->receita, $value->avaliacao, $value->usuario, $value->timestamp);
            }
            return $avaliacao;
        } catch (Exception $ex) {
            var_dump($ex);
        }
        
    }

    function updateAvaliacao() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `avaliacao` SET `receita`= '$this->receita',`avaliacao`= '$this->avaliacao',`usuario`= '$this->usuario',`timestamp`= '$this->timestamp' WHERE `id` = $this->id");
            return $connect;
        } catch (Exception $ex) {
            var_dump($ex);
            return false;
        }
    }

    function executeQuery($query) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB($query);

            $avaliacoes = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->receita) && isset($value->avaliacao) && isset($value->usuario) && isset($value->timestamp)) {
                    $aux = new Avaliacao($value->id, $value->receita, $value->avaliacao, $value->usuario, $value->timestamp);
                    $avaliacoes[] = $aux;

                }
            }
            
           return $avaliacoes;

        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }
}

?>