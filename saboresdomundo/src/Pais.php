<?php

class Pais {

    private $id;
    private $nome;
    private $localidade;
    private $timestamp;

    function __construct($id = "", $nome = "", $localidade = "", $timestamp = "") {
        $this->id = $id;
        $this->nome =  addslashes($nome);
        $this->localidade =  addslashes($localidade);
        $this->timestamp = $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getLocalidade() {
        return $this->localidade;
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome =  addslashes($nome);
    }

    function setLocalidade($localidade) {
        $this->localidade =  addslashes($localidade);
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    
    function insertPais() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `pais`(`nome`, `localidade`) "
                        . "VALUES ('" . $this->nome . "', '" . $this->localidade . "')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectPaisId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `pais` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->nome = $connect[0]->nome;
            $this->localidade = $connect[0]->localidade;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `pais`");

            $pais = [];

            foreach ($connect as $key => $value) {
                $pais[] = new Pais($value->id, $value->nome, $value->localidade, $value->timestamp);
            }
            return $pais;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updatePais() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `pais` SET `nome`= '$this->nome', `localidade`= '$this->localidade', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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

            $pais = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->nome) && isset($value->localidade) && isset($value->timestamp)) {
                    $aux = new Pais($value->id, $value->nome, $value->localidade, $$value->timestamp);
                    $pais[] = $aux;
                }
            }

            return $pais;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }

}
?>

