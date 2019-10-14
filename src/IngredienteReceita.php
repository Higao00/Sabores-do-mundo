<?php

class IngredienteReceita {

    private $id;
    private $ingrediente;
    private $quantidade;
    private $receita;
    private $timestamp;

    function __construct($id = "", $ingrediente = "", $quantidade = "", $receita = "", $timestamp = "") {
        $this->id = $id;
        $this->ingrediente =  utf8_decode(addslashes($ingrediente));
        $this->quantidade =  utf8_decode(addslashes($quantidade));
        $this->receita =  utf8_decode(addslashes($receita));
        $this->timestamp =  $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getIngrediente() {
        return utf8_encode($this->ingrediente);
    }

    function getQuantidade() {
        return utf8_encode($this->quantidade);
    }

    function getReceita() {
        return utf8_encode($this->receita);
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIngrediente($ingrediente) {
        $this->ingrediente =  utf8_decode(addslashes($ingrediente));
    }

    function setQuantidade($quantidade) {
        $this->quantidade =  utf8_decode(addslashes($quantidade));
    }

    function setReceita($receita) {
        $this->receita =  utf8_decode(addslashes($receita));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    function insertIngredienteReceita() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `ingrediente_receita`(`ingrediente`, `quantidade`, `receita`) "
                        . "VALUES ('" . $this->ingrediente . "', '" . $this->quantidade . "', '". $this->receita ."')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectIngredienteReceitaId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `ingrediente_receita` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->ingrediente = $connect[0]->ingrediente;
            $this->quantidade = $connect[0]->quantidade;
            $this->receita = $connect[0]->receita;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `ingrediente_receita`");

            $ingredienteReceita = [];

            foreach ($connect as $value) {
                $ingredienteReceita[] = new IngredienteReceita($value->id, $value->ingrediente, $value->quantidade, $value->receita, $value->timestamp);
            }
            return $ingredienteReceita;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateIngredienteReceita() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `ingrediente_receita` SET `ingrediente`= '$this->ingrediente', `quantidade`= '$this->quantidade', `receita` = '$this->receita' `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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

            $ingredienteReceita = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->ingrediente) && isset($value->quantidade) && isset($value->receita) && isset($value->timestamp)) {
                    $aux = new IngredienteReceita($value->id, $value->ingrediente, $value->quantidade,$value->receita, $value->timestamp);
                    $ingredienteReceita[] = $aux;
                }
            }

            return $ingredienteReceita;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }
    

}
?>