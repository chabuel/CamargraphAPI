<?php
    class User{

        // Connection
        private $conn;

        // Table
        private $db_table = "users";

        // Columns
        public $user_id;
        public $user_name;
        public $user_mail;
        public $user_pwd;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function readUsers(){
            $sqlQuery = "SELECT user_id, user_name, user_mail, user_pwd FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        user_name = :user_name, 
                        user_mail = :user_mail,  
                        user_pwd = :user_pwd";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->user_name=htmlspecialchars(strip_tags($this->user_name));
            $this->user_mail=htmlspecialchars(strip_tags($this->user_mail));
            $this->user_pwd=htmlspecialchars(strip_tags($this->user_pwd));
        
            // bind data
            $stmt->bindParam(":user_name", $this->user_name);
            $stmt->bindParam(":user_mail", $this->user_mail);
            $stmt->bindParam(":user_pwd", $this->user_pwd);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ one
        public function readOneUser(){
            $sqlQuery = "SELECT
                        user_id, 
                        user_name, 
                        user_mail, 
                        user_pwd
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       user_id = 1
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->user_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->user_name = $dataRow['user_name'];
            $this->user_mail = $dataRow['user_mail'];
            $this->user_pwd = $dataRow['user_pwd'];
        }        

        // UPDATE
        public function updateUser(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        user_name = :user_name, 
                        user_mail = :user_mail, 
                        user_pwd = :user_pwd
                    WHERE 
                        user_id = :user_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->user_name=htmlspecialchars(strip_tags($this->user_name));
            $this->user_mail=htmlspecialchars(strip_tags($this->user_mail));
            $this->user_pwd=htmlspecialchars(strip_tags($this->user_pwd));
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        
            // bind data
            $stmt->bindParam(":user_name", $this->user_name);
            $stmt->bindParam(":user_mail", $this->user_mail);
            $stmt->bindParam(":user_pwd", $this->user_pwd);
            $stmt->bindParam(":user_id", $this->user_id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUser(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE user_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        
            $stmt->bindParam(1, $this->user_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>