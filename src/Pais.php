<?php

class Pais {

    private $id;
    private $nome;
    private $localidade;
    private $path_icon;
    private $timestamp;

    function __construct($id = "", $nome = "", $localidade = "", $path_icon = "", $timestamp = "") {
        $this->id = $id;
        $this->nome =  (addslashes($nome));
        $this->localidade =  (addslashes($localidade));
        $this->path_icon = $path_icon;
        $this->timestamp = $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return ($this->nome);
    }

    function getLocalidade() {
        return ($this->localidade);
    }

    function getPath_icon() {
        return ($this->path_icon);
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome =  (addslashes($nome));
    }

    function setLocalidade($localidade) {
        $this->localidade =  (addslashes($localidade));
    }

    function setPath_icon($icon) {
        $this->path_icon =  (addslashes($path_icon));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    
    function insertPais() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `pais`(`nome`, `localidade`, `path_icon`) "
                        . "VALUES ('" . $this->nome . "', '" . $this->localidade . "', '" . $this->path_icon . "')");
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
            $this->path_icon = $connect[0]->path_icon;
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
                $pais[] = new Pais($value->id, $value->nome, $value->localidade, $value->path_icon, $value->timestamp);
            }
            return $pais;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updatePais() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `pais` SET `nome`= '$this->nome', `localidade`= '$this->localidade', `path_icon`= '$this->path_icon', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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
                if (isset($value->id) && isset($value->nome) && isset($value->localidade) && isset($value->path_icon) && isset($value->timestamp)) {
                    $aux = new Pais($value->id, $value->nome, $value->localidade, $value->path_icon , $$value->timestamp);
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