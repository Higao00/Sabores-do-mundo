<?php

class Receita{
    private $id;
    private $titulo;
    private $modo_preparo;
    private $usuario;
    private $timestamp;
    
    function __construct($id="", $titulo="", $modo_preparo="", $usuario="", $timestamp="") {
        $this->id = $id;
        $this->titulo =  (addslashes($titulo));
        $this->modo_preparo =  (addslashes($modo_preparo));
        $this->usuario =  (addslashes($usuario));
        $this->timestamp = $timestamp;
    }
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return utf8_encode($this->titulo);
    }

    function getModo_preparo() {
        return utf8_encode($this->modo_preparo);
    }

    function getUsuario() {
        return utf8_encode($this->usuario);
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo =  utf8_decode(addslashes($titulo));
    }

    function setModo_preparo($modo_preparo) {
        $this->modo_preparo =  utf8_decode(addslashes($modo_preparo));
    }

    function setUsuario($usuario) {
        $this->usuario =  utf8_decode(addslashes($usuario));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    
    function insertReceita() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `receita`(`titulo`, `modo_preparo`, `usuario`) "
                        . "VALUES ('" . $this->titulo . "','".$this->modo_preparo."' ,'" . $this->usuario . "')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectReceitaId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `receita` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->titulo = $connect[0]->titulo;
            $this->modo_preparo = $connect[0]->modo_preparo;
            $this->usuario = $connect[0]->usuario;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `receita`");

            $receita = [];

            foreach ($connect as $key => $value) {
                $receita[] = new Receita($value->id, $value->titulo, $this->modo_preparo, $value->usuario, $value->timestamp);
            }
            return $receita;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateReceita() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `receita` SET `titulo`= '$this->titulo',`modo_preparo`= '$this->modo_preparo', `usuario`= '$this->usuario', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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

            $receita = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->titulo) && isset($value->modo_preparo) && isset($value->usuario) && isset($value->timestamp)) {
                    $aux = new Receita($value->id, $value->titulo, $value->modo_preparo, $value->usuario, $value->timestamp);
                    // $aux = new Receita();

                    // $aux->setId($value->id);
                    // $aux->setTitulo($value->titulo);
                    // $aux->setModo_preparo($value->modo_preparo);
                    // $aux->setUsuario($value->usuario);
                    // $aux->setTimestamp($value->timestamp);

                    $receita[] = $aux;
                }
            }

            return $receita;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }

}

?>

