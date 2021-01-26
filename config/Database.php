<?php

class Database{
    //DB Params
    private $host = 'localhost';
    private $db_name = 'dryfruits_db';
    private $username = 'root';
    private $password = 'root';
    private $conn;

    //create a method to connect
    public function connect(){
        //set connection property to null
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo 'Connection Error:'.$e->getMessage();
        }
        return $this->conn;
    }
}