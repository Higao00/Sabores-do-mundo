<?php

class Ingrediente {

    private $id;
    private $nome;
    private $medida;
    private $timestamp;

    function __construct($id = "", $nome = "", $medida = "", $timestamp = "") {
        $this->id = $id;
        $this->nome = $nome;
        $this->medida = $medida;
        $this->timestamp = $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getMedida() {
        return $this->medida;
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setMedida($medida) {
        $this->medida = $medida;
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    function insertIngrediente() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `ingrediente`(`nome`, `medida`) "
                        . "VALUES ('" . $this->nome . "', '" . $this->medida . "')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectIngredienteId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `ingrediente` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->nome = $connect[0]->nome;
            $this->medida = $connect[0]->medida;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `ingrediente`");

            $ingrediente = [];

            foreach ($connect as $key => $value) {
                $ingrediente[] = new Ingrediente($value->id, $value->nome, $value->medida, $value->timestamp);
            }
            return $ingrediente;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateIngrediente() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `ingrediente` SET `nome`= '$this->nome', `medida`= '$this->medida', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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

            $ingrediente = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->nome) && isset($value->medida) && isset($value->timestamp)) {
                    $aux = new Ingrediente($value->id, $value->nome, $value->medida, $$value->timestamp);
                    $ingrediente[] = $aux;
                }
            }

            return $ingrediente;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }
    
    
    
}
?>

