<?php

class Database {
    //Initilisation de la connexion a la bdd
    private $host = "localhost";
    private $name_db = "ClickAndCollect";
    private $username = "Admin";
    private $password = "Admin";
    public $connexion;

    //Getter connexin
    public function getConnection(){

    $this->connexion = null;

    try{
        $this->connexion = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->name_db, $this->username, $this->password);
        $this->connexion->exec("set names utf8");
    }catch(PDOException $exception){
        echo "Erreur de connexion : " . $exception->getMessage();
    }

    return $this->connexion;

    }
}

