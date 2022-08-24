<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization");

/* include ('../DataBases.php');

include ('./Posts.php');

    $database = new Database();
    $db = $database->getConnection();

    $item = new Post($db);

    $data = json_decode(file_get_contents("php://input"));

    /* $post_img = $_FILES['File']['name'];

    $upload = "../Images/".$post_img;           
    move_uploaded_file($_FILES['File']['tmp_name'], $upload); 

    if(isset($_POST) && !empty($_FILES['File']['name']) 
        && !empty($_POST['post_fr_title'])
        && !empty($_POST['post_en_title'])
        && !empty($_POST['post_fr_view'])
        && !empty($_POST['post_en_view'])
        && !empty($_POST['post_fr_desc'])
        && !empty($_POST['post_en_desc']))
        {

        //$_FILES existe on récupère les infos qui nous intéressent
        $File=$_FILES['File']['name'];//nom réel de l'image
        $size=$_FILES['File']['size']; //poids de l'image en octets
        $tmp=$_FILES['File']['tmp_name'];//nom temporaire de l'image (sur le serveur)
        $type=$_FILES['File']['type'];//type de l'image

        //On récupère la taille de l'image
        list($width,$height)=getimagesize($tmp);
        if (is_uploaded_file($tmp)) //permet de vérifier si le File a été uplodé via http
        {
            //vérification du type de l'img, son poids et sa taille
            if ($size<=2000500 && $width<=6000 && $height<=20000 )
            {
                // type mime gif, poids < à 20500 octets soit environ 2000Ko, largeur = hauteur = 500px
                //Pour supprimer les espaces dans les noms de Files car celà entraîne une erreur lorsque vous voulez l'afficher
                $File = preg_replace("` `i","",$File);
                //On vérifie s'il existe une image qui a le même nom dans le répertoire
                if (file_exists('../Images/'.$File))
                {
                    //Le File existe on rajoute dans son nom le timestamp du moment pour le différencier de la première (comme cela on est sûr de ne pas avoir 2 images avec le même nom :) )
                    $post_img= preg_replace("`.gif`is",date("U").".gif",$File);
                }
                else {
                    $post_img=$File; //l'image n'existe pas on garde le même nom
                }
                //on déplace l'image dans le répertoire final
                move_uploaded_file($tmp,'../Images/'.$post_img);
                //Message indiquant que tout s'est bien passé

                $item->post_fr_title = $data->post_fr_title;
                $item->post_en_title = $data->post_en_title;
                $item->post_fr_view = $data->post_fr_view;
                $item->post_en_view = $data->post_en_view;
                $item->post_fr_desc = $data->post_fr_desc;
                $item->post_en_desc = $data->post_en_desc;
                $item->post_img = $data->post_img;
                $item->post_date = date('Y-m-d H:i:s');
            }
            else {
                //Le type mime, ou la taille ou le poids est incorrect
                echo 'Votre image a été rejetée (poids, taille ou type incorrect)';
                $upload_img = false;
            }
        }
    }
     
    if($item->createPost()){
        echo json_encode(["success" => 1, "msg" => "Post Inserted."]);
    } else{
        echo json_encode(["success" => 0, "msg" => "Post Not Inserted!"]);
    } */

    
    include ('../Database.php'); // include database connection file
    
    $data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format

        
    $postimg  =  $_FILES['post_img']['name'];
    $tempPath  =  $_FILES['post_img']['tmp_name'];
    $fileSize  =  $_FILES['post_img']['size'];
            
    if(empty($postimg))
    {
        $errorMSG = json_encode(array("message" => "please select image", "status" => false));	
        echo $errorMSG;
    }
    else
    {
        $upload_path = '../Images/'; // set upload folder path 
        
        $fileExt = strtolower(pathinfo($postimg,PATHINFO_EXTENSION)); // get image extension
            
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
                        
        // allow valid image file formats
        if(in_array($fileExt, $valid_extensions))
        {				
            //check file not exist our upload folder path
            if(!file_exists($upload_path . $postimg))
            {
                // check file size '5MB'
                if($fileSize < 5000000){
                    move_uploaded_file($tempPath, $upload_path . $postimg); // move file from system temporary path to our upload folder path 
                }
                else{		
                    $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));	
                    echo $errorMSG;
                }
            }
            else
            {		
                $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));	
                echo $errorMSG;
            }
        }
        else
        {		
            $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));	
            echo $errorMSG;		
        }
    }
        $postfrtitle = mysqli_real_escape_string($db_connection, trim($_POST['post_fr_title']));
        $postentitle = mysqli_real_escape_string($db_connection, trim($_POST['post_en_title']));
        $postfrview = mysqli_real_escape_string($db_connection, trim($_POST['post_fr_view']));
        $postenview = mysqli_real_escape_string($db_connection, trim($_POST['post_en_view']));
        $postfrdesc = mysqli_real_escape_string($db_connection, trim($_POST['post_fr_desc']));
        $postendesc = mysqli_real_escape_string($db_connection, trim($_POST['post_en_desc']));
        $postimg = mysqli_real_escape_string($db_connection, trim($_FILES['post_img']['name'])); 
        $createPost = mysqli_query($db_connection,"INSERT INTO `posts`(`post_fr_title`, `post_en_title`, `post_fr_view`, `post_en_view`, `post_fr_desc`, `post_en_desc`, `post_date`, `post_img`) VALUES('$postfrtitle', '$postentitle', '$postfrview', '$postenview', '$postfrdesc', '$postendesc', CURRENT_TIMESTAMP(), '$postimg')");     
    // if no error caused, continue ....
    if ($createPost) {
        $last_id = mysqli_insert_id($db_connection);
        echo json_encode(["success" => 1, "msg" => "Post Inserted.", "id" => $last_id]);
    } else {
        echo json_encode(["success" => 0, "msg" => "Post Not Inserted, please fill all the required fields!!"]);
    }

    function get_data_fr()  
 {  
    require 'db_connection.php';

    $lastPost = mysqli_query($db_conn, "SELECT post_id, post_fr_title, post_fr_view, post_fr_desc, post_date, post_img FROM posts ORDER BY post_id DESC LIMIT 0,5");  
      $post_data = array();
      while($row = mysqli_fetch_array($lastPost))  
      {  
           $post_data[] = array (
                'post_id'               =>     $row["post_id"],  
                'title'          =>     $row["post_fr_title"],  
                'overview'     =>     $row["post_fr_view"],
                'description'  =>     $row["post_fr_desc"],  
                'date'          =>     $row["post_date"],  
                'image'     =>     $row["post_img"]    
           );  
      }  
      return json_encode($post_data, JSON_UNESCAPED_UNICODE);  
 }  
 
    $dir = 'C:/wamp64/www/mon-app/Front End/src/locales/fr/';
    $file_name = 'fr_translation' . ".json";  
    if(file_put_contents($dir . $file_name, get_data_fr()))  
    {  
        echo $file_name . ' File created';  
    }  
    else  
    {  
        echo 'There is some error';  
    }  

    function get_data_en()  
    {  
       require 'db_connection.php';
   
       $lastPost = mysqli_query($db_conn, "SELECT post_id, post_en_title, post_en_view, post_en_desc, post_date, post_img FROM posts ORDER BY post_id DESC LIMIT 0,5");  
       $post_data = array();
         while($row = mysqli_fetch_array($lastPost))  
         {  
              $post_data[] = array (  
                   'post_id'               =>     $row["post_id"],  
                   'title'          =>     $row["post_en_title"],  
                   'overview'     =>     $row["post_en_view"],
                   'description'  =>     $row["post_en_desc"],  
                   'date'          =>     $row["post_date"],  
                   'image'     =>     $row["post_img"]    
              );  
         }  
         return json_encode($post_data, JSON_UNESCAPED_UNICODE);  
    }  
    $dir = 'C:/wamp64/www/mon-app/Front End/src/locales/en/';
       $file_name = 'en_translation' . ".json";  
       if(file_put_contents($dir . $file_name, get_data_en()))  
       {  
           echo $file_name . ' File created';  
       }  
       else  
       {  
           echo 'There is some error';  
       }

 ?>
?>
