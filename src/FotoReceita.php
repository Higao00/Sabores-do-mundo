<?php

class FotoReceita {

    private $id;
    private $receita;
    private $path_foto;
    private $usuario;
    private $timestamp;

    function __construct($id = "", $receita = "", $path_foto = "", $usuario = "", $timestamp = "") {
        $this->id = $id;
        $this->receita =  utf8_decode(addslashes($receita));
        $this->path_foto = utf8_decode(addslashes($path_foto));
        $this->usuario =  utf8_decode(addslashes($usuario));
        $this->timestamp = $timestamp;
    }

    function getId() {
        return $this->id;
    }

    function getReceita() {
        return utf8_encode($this->receita);
    }

    function getPath_foto() {
        return utf8_encode($this->path_foto);
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

    function setReceita($receita) {
        $this->receita =  utf8_decode(addslashes($receita));
    }

    function setPath_foto($path_foto) {
        $this->path_foto =  utf8_decode(addslashes($path_foto));
    }

    function setUsuario($usuario) {
        $this->usuario =  utf8_decode(addslashes($usuario));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    
    function insertFotoReceita() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `foto_receita`(`receita`, `path_foto`, `usuario`) "
                        . "VALUES ('" . $this->receita . "','" . $this->path_foto . "','$this->usuario')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectFotoReceitaId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `foto_receita` WHERE `id` = " . $id);

            if(count($connect)){
                $this->id = $connect[0]->id;
                $this->receita = $connect[0]->receita;
                $this->path_foto = $connect[0]->path_foto;
                $this->usuario = $connect[0]->usuario;
                $this->timestamp = $connect[0]->timestamp;
            }
           
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `foto_receita`");

            $fotoReceita = [];

            foreach ($connect as $key => $value) {
                $fotoReceita[] = new FotoReceita($value->id, $value->receita, $value->path_foto, $value->usuario, $value->timestamp);
            }
            return $fotoReceita;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateFotoReceita() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `foto_receita` SET `receita`= '$this->receita',`path_foto`= '$this->path_foto',`usuario`= '$this->usuario',`timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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

            $fotoReceita = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->receita) && isset($value->path_foto) && isset($value->usuario) && isset($value->timestamp)) {
                    $aux = new FotoReceita($value->id, $value->receita, $value->path_foto, $value->usuario, $value->timestamp);
                    $fotoReceita[] = $aux;
                }
            }

            return $fotoReceita;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }

}
?>