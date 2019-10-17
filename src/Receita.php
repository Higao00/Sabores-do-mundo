<?php

class Receita{
    private $id;
    private $titulo;
    private $modo_preparo;
    private $usuario;
    private $categoria;
    private $pais;
    private $tempo_preparo;
    private $timestamp;


    
    function __construct($id="", $titulo="", $modo_preparo="", $usuario="", $categoria="", $pais="", $tempo_preparo="", $timestamp="") {
        $this->id = $id;
        $this->titulo =  (addslashes($titulo));
        $this->modo_preparo =  (addslashes($modo_preparo));
        $this->usuario =  (addslashes($usuario));
        $this->categoria = addslashes($categoria);
        $this->pais = addslashes($pais);
        $this->tempo_preparo = addslashes($tempo_preparo);
        $this->timestamp = $timestamp;
    }
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return ($this->titulo);
    }

    function getModo_preparo() {
        return ($this->modo_preparo);
    }

    function getUsuario() {
        return ($this->usuario);
    }

    function getCategoria(){
        return $this->categoria;
    }

    function getPais() {
        return $this->pais;
    }

    function getTempo_preparo() {
        return $this->tempo_preparo;
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

    function setModo_preparo($modo_preparo) {
        $this->modo_preparo =  (addslashes($modo_preparo));
    }

    function setUsuario($usuario) {
        $this->usuario =  (addslashes($usuario));
    }

    function setCategoria($categoria) {
        $this->categoria =  (addslashes($categoria));
    }

    function setPais($pais) {
        $this->pais =  (addslashes($pais));
    }

    function setTempo_preparo($tempo_preparo) {
        $this->tempo_preparo =  (addslashes($tempo_preparo));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    
    function insertReceita() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `receita`(`titulo`, `modo_preparo`, `usuario`, `categoria`, `pais`, `tempo_preparo`) "
                        . "VALUES ('" . $this->titulo . "','".$this->modo_preparo."' ,'" . $this->usuario . "','" . $this->categoria . "','" . $this->pais . "','" . $this->tempo_preparo . "')");
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
            $this->categoria = $connect[0]->categoria;
            $this->pais = $connect[0]->pais;
            $this->tempo_preparo = $connect[0]->tempo_preparo;
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
                $receita[] = new Receita($value->id, $value->titulo, $value->modo_preparo, $value->usuario, $value->categoria, $value->pais, $value->tempo_preparo, $value->timestamp);
            }
            return $receita;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateReceita() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `receita` SET `titulo`= '$this->titulo',`modo_preparo`= '$this->modo_preparo', `usuario`= '$this->usuario', `categoria`= '$this->categoria', `pais`= '$this->pais', `tempo_preparo`= '$this->tempo_preparo', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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
                if (isset($value->id) && isset($value->titulo) && isset($value->modo_preparo) && isset($value->usuario) && isset($value->categoria) && isset($value->pais)&& isset($value->tempo_preparo) && isset($value->timestamp)) {
                    $aux = new Receita($value->id, $value->titulo, $value->modo_preparo, $value->usuario, $value->categoria, $value->pais, $value->tempo_preparo, $value->timestamp);
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