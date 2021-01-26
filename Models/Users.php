<?php

class Users{
    //Db
    private $conn;
    private $table = 'user_table';

    //Users properties
    public $user_id;
    public $user_name;
    public $user_phone;
    public $user_email;
    public $user_password;

    //constructor
    public function __construct($db){
        $this->conn = $db;
    }

    //get users
    public function read(){
        //query
        $query = "SELECT * FROM $this->table";

        //prepare stmt
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();

        return $stmt;
    }

    //get single users
    public function readSingle(){
        //query
        $query = "SELECT * FROM $this->table WHERE user_id =:user_id";

        //prepare stmt
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id',$this->user_id);
        //execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set properties
        $this->user_id = $row['user_id'];
        $this->user_name = $row['user_name'];
        $this->user_email = $row['user_email'];
        $this->user_phone = $row['user_phone'];
    }

    //add new category
    public function create(){
        $query = 'INSERT INTO '.$this->table.'
            SET 
            user_name =:user_name,
            user_phone =:user_phone,
            user_email =:user_email,
            user_password =:user_password
        ';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_phone = htmlspecialchars(strip_tags($this->user_phone));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        
        //bind data
        $stmt->bindParam(':user_name',$this->user_name);
        $stmt->bindParam(':user_phone',$this->user_phone);
        $stmt->bindParam(':user_email',$this->user_email);
        $stmt->bindParam(':user_password',$this->user_password);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }
    }

    //Update User
    public function update(){
        $query = 'UPDATE '.$this->table.'
            SET 
            user_name =:user_name,
            user_phone =:user_phone,
            user_email =:user_email,
            user_password =:user_password
            WHERE 
            user_id=:user_id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->user_name = htmlspecialchars(strip_tags($this->user_name));
        $this->user_phone = htmlspecialchars(strip_tags($this->user_phone));
        $this->user_email = htmlspecialchars(strip_tags($this->user_email));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        
        //bind data
        $stmt->bindParam(':user_id',$this->user_id);
        $stmt->bindParam(':user_name',$this->user_name);
        $stmt->bindParam(':user_phone',$this->user_phone);
        $stmt->bindParam(':user_email',$this->user_email);
        $stmt->bindParam(':user_password',$this->user_password);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }
    }

    public function delete(){
        $query = "DELETE FROM $this->table WHERE user_id = :user_id";
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        //bind data
        $stmt->bindParam(':user_id',$this->user_id);

        //Execute query
        if($stmt->execute()){
            return true;
        }

        //print error
        printf("Error: %s.\n",$stmt->error);

        return false;
    }
}