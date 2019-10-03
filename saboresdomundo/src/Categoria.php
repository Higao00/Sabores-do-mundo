<?php

class Categoria {

    private $id;
    private $titulo;
    private $timestamp;

    function __construct($id="", $titulo="", $timestamp="") {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->timestamp = $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    function insertCategoria() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `categoria`(`titulo`) "
                        . "VALUES ('" . $this->titulo . "')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectCategoriaId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `categoria` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->titulo = $connect[0]->titulo;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `categoria`");

            $categoria = [];

            foreach ($connect as $key => $value) {
                $categoria[] = new Categoria($value->id, $value->titulo, $value->timestamp);
            }
            return $categoria;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateCategoria() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `categoria` SET `titulo`= '$this->titulo', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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

            $categoria = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->titulo) && isset($value->timestamp)) {
                    $aux = new Categoria($value->id, $value->titulo, $$value->timestamp);
                    $categoria[] = $aux;
                }
            }

            return $categoria;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }

}

?>