<?php
    class Post{

        // Connection
        private $conn;

        // Table
        private $db_table = "posts";

        // Columns
        public $post_id;
        public $post_fr_title;
        public $post_en_title;
        public $post_fr_view;
        public $post_en_view;
        public $post_fr_desc;
        public $post_en_desc;
        public $post_img;
        public $post_date;
        public $user_id;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function readPosts(){
            $sqlQuery = "SELECT post_id, post_fr_title, post_en_title, post_fr_view, post_en_view, post_fr_desc, post_en_desc, post_img, post_date, user_id FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createPost(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        post_fr_title = :post_fr_title,
                        post_en_title = :post_en_title,
                        post_fr_view = :post_fr_view,
                        post_en_view = :post_en_view,
                        post_fr_desc = :post_fr_desc,
                        post_en_desc= :post_en_desc,
                        post_img = :post_img,
                        post_date = :post_date";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->post_fr_title=htmlspecialchars(strip_tags($this->post_fr_title));
            $this->post_en_title=htmlspecialchars(strip_tags($this->post_en_title));
            $this->post_fr_view=htmlspecialchars(strip_tags($this->post_fr_view));
            $this->post_en_view=htmlspecialchars(strip_tags($this->post_en_view));
            $this->post_fr_desc=htmlspecialchars(strip_tags($this->post_fr_desc));
            $this->post_en_desc=htmlspecialchars(strip_tags($this->post_en_desc));
            $this->post_img=htmlspecialchars(strip_tags($this->post_img));
            $this->post_date=htmlspecialchars(strip_tags($this->post_date));
            // bind data
            $stmt->bindParam(":post_fr_title", $this->post_fr_title);
            $stmt->bindParam(":post_en_title", $this->post_en_title);
            $stmt->bindParam(":post_fr_view", $this->post_fr_view);
            $stmt->bindParam(":post_en_view", $this->post_en_view);
            $stmt->bindParam(":post_fr_desc", $this->post_fr_desc);
            $stmt->bindParam(":post_en_desc", $this->post_en_desc);
            $stmt->bindParam(":post_img", $this->post_img);
            $stmt->bindParam(":post_date", $this->post_date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ one
        public function readOnePost(){
            $sqlQuery = "SELECT
                        post_id,
                        post_fr_title,
                        post_en_title,
                        post_fr_view,
                        post_en_view,
                        post_fr_desc,
                        post_en_desc,
                        post_img,
                        post_date,
                        user_id
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       post_id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->post_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->post_fr_title = $dataRow['post_fr_title'];
            $this->post_en_title = $dataRow['post_en_title'];
            $this->post_fr_view = $dataRow['post_fr_view'];
            $this->post_en_view = $dataRow['post_en_view'];
            $this->post_fr_desc = $dataRow['post_fr_desc'];
            $this->post_en_desc = $dataRow['post_en_desc'];
            $this->post_img = $dataRow['post_img'];
            $this->post_date = $dataRow['post_date'];
            $this->user_id = $dataRow['user_id'];
        }        

        // UPDATE
        public function updatePost(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    post_fr_title = :post_fr_title,
                    post_en_title = :post_en_title,
                    post_fr_view = :post_fr_view,
                    post_en_view = :post_en_view,
                    post_fr_desc = :post_fr_desc,
                    post_en_desc= :post_en_desc,
                    post_img = :post_img,
                    post_date = :post_date;

                    WHERE 
                        post_id = :post_id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->post_fr_title=htmlspecialchars(strip_tags($this->post_fr_title));
            $this->post_en_title=htmlspecialchars(strip_tags($this->post_en_title));
            $this->post_fr_view=htmlspecialchars(strip_tags($this->post_fr_view));
            $this->post_en_view=htmlspecialchars(strip_tags($this->post_en_view));
            $this->post_fr_desc=htmlspecialchars(strip_tags($this->post_fr_desc));
            $this->post_en_desc=htmlspecialchars(strip_tags($this->post_en_desc));
            $this->post_img=htmlspecialchars(strip_tags($this->post_img));
            $this->post_date=htmlspecialchars(strip_tags($this->post_date));
            // bind data
            $stmt->bindParam(":post_fr_title", $this->post_fr_title);
            $stmt->bindParam(":post_en_title", $this->post_en_title);
            $stmt->bindParam(":post_fr_view", $this->post_fr_view);
            $stmt->bindParam(":post_en_view", $this->post_en_view);
            $stmt->bindParam(":post_fr_desc", $this->post_fr_desc);
            $stmt->bindParam(":post_en_desc", $this->post_en_desc);
            $stmt->bindParam(":post_img", $this->post_img);
            $stmt->bindParam(":post_date", $this->post_date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletePost(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE post_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->post_id=htmlspecialchars(strip_tags($this->post_id));
        
            $stmt->bindParam(1, $this->post_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>