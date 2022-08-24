<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include ('../Database.php');
include ('./Images.php');

    $database = new Database();
    $db = $database->getConnection();

    $item = new Post($db);

    $data = json_decode(file_get_contents("php://input"));

    /* $post_img = $_FILES['File']['name'];

    $upload = "../Images/".$post_img;           
    move_uploaded_file($_FILES['File']['tmp_name'], $upload);  */


    if (isset($_FILES['File']))
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
            }
            else {
                //Le type mime, ou la taille ou le poids est incorrect
                echo 'Votre image a été rejetée (poids, taille ou type incorrect)';
                $upload_img = false;
            }
        }
    }
  
    $item->name = $data->name;
    $item->name = $data->name;
    
    if($item->createPost()){
        echo json_encode(["success" => 1, "msg" => "Post Inserted."]);
    } else{
        echo json_encode(["success" => 0, "msg" => "Post Not Inserted!"]);
    }
    ?>
}