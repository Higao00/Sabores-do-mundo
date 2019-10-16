<?php

class Categoria {

    private $id;
    private $titulo;
    private $path_icon;
    private $timestamp;

    function __construct($id="", $titulo="", $path_icon="", $timestamp="") {
        $this->id = $id;
        $this->titulo =  (addslashes($titulo));
        $this->path_icon = $path_icon;
        $this->timestamp = $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return ($this->titulo);
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

    function setTitulo($titulo) {
        $this->titulo =  (addslashes($titulo));
    }

    function setPath_icon($path_icon) {
        $this->path_icon =  (addslashes($path_icon));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    function insertCategoria() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `categoria`(`titulo`, `path_icon`) "
                        . "VALUES ('" . $this->titulo . "', '" . $this->path_icon . "')");
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
            $this->path_icon = $connect[0]->path_icon;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            // var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `categoria`");

            $categoria = [];

            foreach ($connect as $key => $value) {
                $categoria[] = new Categoria($value->id, $value->titulo, $value->path_icon, $value->timestamp);
            }
            return $categoria;
        } catch (Exception $ex) {
            // var_dump($ex);
        }
    }

    function updateCategoria() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `categoria` SET `titulo`= '$this->titulo', `path_icon`= '$this->path_icon', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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
                if (isset($value->id) && isset($value->titulo) && isset($value->path_icon) && isset($value->timestamp)) {
                    $aux = new Categoria($value->id, $value->titulo, $value->path_icon, $$value->timestamp);
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