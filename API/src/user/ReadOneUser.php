<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization");
    
    include ('../Database.php');
    include ('./Users.php');

    $database = new Database();
    $db = $database->getConnection();

    $item = new User($db);

    $item->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die();
  
    $item->readOneUser();

    if($item->user_name != null){
        $userArr = array(
            "user_id" =>  $item->user_id,
            "user_name" => $item->user_name,
            "user_mail" => $item->user_mail,
            "user_pwd" => $item->user_pwd
        );
        http_response_code(200);
        echo json_encode($userArr);
    }   
    else{
        http_response_code(404);
        echo json_encode("User not found.");
    }
?>