<?php

class ReceitaFavorita{
    
    private $id;
    private $receita;
    private $usuario;
    private $timestamp;
    
    function __construct($id="", $receita="", $usuario="", $timestamp="") {
        $this->id = $id;
        $this->receita =  utf8_decode(addslashes($receita));
        $this->usuario =  utf8_decode(addslashes($usuario));
        $this->timestamp = $timestamp;
    }
    
    function getId() {
        return $this->id;
    }

    function getReceita() {
        return utf8_encode($this->receita);
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

    function setUsuario($usuario) {
        $this->usuario =  utf8_decode(addslashes($usuario));
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    
    function insertReceitaFavorita() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `receita_favorita`(`receita`, `usuario`) "
                        . "VALUES ('" . $this->receita . "', '" . $this->usuario . "')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectReceitaFavoritaId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `receita_favorita` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->receita = $connect[0]->receita;
            $this->usuario = $connect[0]->usuario;
            $this->timestamp = $connect[0]->timestamp;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `receita_favorita`");

            $receita_favorita = [];

            foreach ($connect as $key => $value) {
                $receita_favorita[] = new ReceitaFavorita($value->id, $value->receita, $value->usuario, $value->timestamp);
            }
            return $receita_favorita;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateReceitaFavorita() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `receita_favorita` SET `receita`= '$this->receita', `usuario`= '$this->usuario', `timestamp`= '$this->timestamp' WHERE `id` = $this->id");
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

            $receita_favorita = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->receita) && isset($value->usuario) && isset($value->timestamp)) {
                    $aux = new ReceitaFavorita($value->id, $value->receita, $value->usuario, $$value->timestamp);
                    $receita_favorita[] = $aux;
                }
            }

            return $receita_favorita;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }

}

?>

