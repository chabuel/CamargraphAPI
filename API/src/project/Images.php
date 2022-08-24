<?php
    class Image{

        // Connection
        private $conn;

        // Table
        private $db_table = "images";

        // Columns
        public $id;
        public $name;
        public $image;
       

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function readImages(){
            $sqlQuery = "SELECT id, name, image FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createImage(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name,
                        image = :image";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->image=htmlspecialchars(strip_tags($this->image));
            
            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":image", $this->image);
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ one
        public function readOneImage(){
            $sqlQuery = "SELECT
                        id,
                        name,
                        image
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            $this->name = $dataRow['name'];
            $this->image = $dataRow['image'];
        }        

        // UPDATE
        public function updateImage(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    id = :id,
                    name = :name,
                    image = :image;
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->image=htmlspecialchars(strip_tags($this->image));
            
            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":image", $this->image);
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteImage(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>