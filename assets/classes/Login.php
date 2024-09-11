<?php

class Login
{

    private $id;

    private $email;

    private $mdp;


    public function getID()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMdp()
    {
        return $this->mdp;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setMotdepasse($mdp)
    {
        $this->mdp = $mdp;
    }

    /* Doit renvoyer un bool*/
    public function checkAccess($email, $mdp)
    {
        $db = new Db;
        $co = $db->dbCo("socknnect", "root", "root");

        $sql = "SELECT `email`, SHA1(`password`) `password` FROM `user` WHERE email = ? AND password = ?";
        $param = [$email, sha1($mdp)];
        $result = $db->SQLWithParam($sql, $param, $co);
        return !empty($result);
    }

    public function connect()
    {
        header("Location: ../index.php");
    }
}
