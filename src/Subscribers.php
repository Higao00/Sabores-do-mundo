<?php

class Subscribers {

    private $id;
    private $endpoint;
    private $auth;
    private $p256dh;
    private $usuario;
    private $status;

    function __construct($id = "", $endpoint = "", $auth = "", $p256dh = "", $usuario = "", $status = "") {
        $this->id = $id;
        $this->endpoint = $endpoint;
        $this->auth = $auth;
        $this->p256dh = $p256dh;
        $this->usuario = $usuario;
        $this->status = $status;
    }

    function getId() {
        return $this->id;
    }

    function getEndpoint() {
        return $this->endpoint;
    }

    function getAuth() {
        return $this->auth;
    }

    function getP256dh() {
        return $this->p256dh;
    }

    function getUsuario() {
        return $this->usuario;
    }
       
    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;
    }

    function setAuth($auth) {
        $this->auth = $auth;
    }

    function setP256dh($p256dh) {
        $this->p256dh = $p256dh;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    function setStatus($status) {
        $this->status = $status;
    }

    function insertSubscribers() {
        if (empty($this->id)) {
            $conexao = new conexao();
            try {
                $connect = $conexao->insertDB("INSERT INTO `subscribers`(`endpoint`, `auth`, `p256dh`, `usuario`, `status`) "
                        . "VALUES ('" . $this->endpoint . "','" . $this->auth . "' , '".$this->p256dh."', '" . $this->usuario . "', '" . $this->status . "')");
                $this->id = $connect;

                return $connect;
            } catch (Exception $ex) {
                //var_dump($ex);
            }
        } else {
            return false;
        }
    }

    function selectSubscribersId($id) {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `subscribers` WHERE `id` = " . $id);

            $this->id = $connect[0]->id;
            $this->endpoint = $connect[0]->endpoint;
            $this->auth = $connect[0]->auth;
            $this->p256dh = $connect[0]->p256dh;
            $this->usuario = $connect[0]->usuario;
            $this->status = $connect[0]->status;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function selectAll() {
        $conexao = new conexao();
        try {
            $connect = $conexao->selectDB("SELECT * FROM `subscribers`");

            $subscribers = [];

            foreach ($connect as $key => $value) {
                $subscribers[] = new Subscribers($value->id, $value->endpoint, $this->auth, $value->p256dh, $value->usuario , $value->status);
            }
            return $subscribers;
        } catch (Exception $ex) {
            var_dump($ex);
        }
    }

    function updateSubscribers() {
        $conexao = new conexao();
        try {
            $connect = $conexao->updateDB("UPDATE `subscribers` SET `endpoint`= '$this->endpoint',`auth`= '$this->auth', `usuario`= '$this->usuario', `p256dh`= '$this->p256dh', `status` = '$this->staus' WHERE `id` = $this->id");
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

            $subscribers = [];

            foreach ($connect as $key => $value) {
                if (isset($value->id) && isset($value->endpoint) && isset($value->auth) && isset($value->usuario) && isset($value->p256dh) && isset($value->status)) {
                    $aux = new Subscribers($value->id, $value->endpoint, $value->auth, $value->usuario, $value->p256dh, $value->p256dh);
                    $subscribers[] = $aux;
                }
            }

            return $subscribers;
        } catch (Exception $ex) {
            //var_dump($ex);
            return false;
        }
    }

}
?>

