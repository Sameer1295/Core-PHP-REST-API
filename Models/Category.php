<?php
class Category{
    //DB stuff
    private $conn;
    private $table = 'category_table';

    //Category properties
    public $category_id;
    public $category_name;
    public $category_status;
    
    //Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    //Get category
    public function read(){
        //Create query
        $query = "SELECT * FROM $this->table";
        //prepare stmt
        $stmt = $this->conn->prepare($query);
        //execute stmt
        $stmt->execute();
        
        return $stmt;
    }

    //get single category details
    public function readSingle(){
        //Create query
        $query = "SELECT * FROM $this->table WHERE category_id = :category_id";
        //prepare stmt
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('category_id',$this->id);
        //execute stmt
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set properties
        $this->id = $row['category_id'];
        $this->name = $row['category_name'];
        $this->status = $row['category_status'];       
    }

    //add new category
    public function create(){
        $query = 'INSERT INTO '.$this->table.'
            SET 
            category_name =:category_name,
            category_status =:category_status
        ';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        $this->category_status = htmlspecialchars(strip_tags($this->category_status));
        
        //bind data
        $stmt->bindParam('category_name',$this->category_name);
        $stmt->bindParam('category_status',$this->category_status);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }

        //print error if something goes wrong
        printf("Error:%s.\n",$stmt->error);

        return false;
    }

    //Update new category
    public function update(){
        $query = 'UPDATE '.$this->table.'
            SET 
            category_name =:category_name,
            category_status =:category_status
            WHERE 
            category_id=:category_id';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->category_name = htmlspecialchars(strip_tags($this->category_name));
        $this->category_status = htmlspecialchars(strip_tags($this->category_status));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //bind data
        $stmt->bindParam('category_name',$this->category_name);
        $stmt->bindParam('category_status',$this->category_status);
        $stmt->bindParam('category_id',$this->category_id);
        
        //Execute query
        if($stmt->execute()){
            return true;
        }

        //print error if something goes wrong
        printf("Error:%s.\n",$stmt->error);

        return false;
    }

    //delete category
    public function delete(){
        $query = "DELETE FROM $this->table WHERE category_id = :category_id";
        
        //prepare statement
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //bind data
        $stmt->bindParam('category_id',$this->category_id);

        //Execute query
        if($stmt->execute()){
            return true;
        }

        //print error
        printf("Error: %s.\n",$stmt->error);

        return false;
    }
}