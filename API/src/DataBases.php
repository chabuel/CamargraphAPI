<?php

Class Database {

    private $host = "eu-cdbr-west-02.cleardb.net";
    private $database_name = "heroku_e4f2db4d9585338";
    private $username = "bf41c4382ba64d";
    private $password = "3d66820f";

    public $conn;

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->conn;
    } 
} 
