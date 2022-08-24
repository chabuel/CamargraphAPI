<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include ('../Database.php');

$data = json_decode(file_get_contents("php://input"));


    $username = mysqli_real_escape_string($db_connection, trim($data->user_name));
    $usermail = mysqli_real_escape_string($db_connection, trim($data->user_mail));
    $userpwd = mysqli_real_escape_string($db_connection, trim($data->user_pwd));
    $createUser = mysqli_query($db_connection, "INSERT INTO `users`(`user_name`,`user_mail`,`user_pwd`) VALUES('$username','$usermail','$userpwd')");
    if ($createUser) {
        $last_id = mysqli_insert_id($db_connection);
        echo json_encode(["success" => 1, "msg" => "User Inserted.", "id" => $last_id]);
    } else {
        echo json_encode(["success" => 0, "msg" => "User Not Inserted, please fill all the required fields!!"]);
    }

/* include ('../Database.php');
include ('./Users.php');

    $database = new Database();
    $db = $database->getConnection();

    $item = new User($db);

    $data = json_decode(file_get_contents("php://input"));
    
    $item->user_name = $data->user_name;
    $item->user_mail = $data->user_mail;
    $item->user_pwd = $data->user_pwd;

    if($item->createUser()){
        echo json_encode(["success" => 1, "msg" => "User Inserted."]);
    } else{
        echo json_encode(["success" => 0, "msg" => "User Not Inserted!"]);
    }
 */