<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include ('../Database.php');

$data = json_decode(file_get_contents("php://input"));

if (isset($data->user_id) && is_numeric($data->user_id))     
    {
    $delID = $data->user_id;
    $deleteUser = mysqli_query($db_connection, "DELETE FROM `users` WHERE `user_id`='$delID'");
    if ($deleteUser) {
        echo json_encode(["success" => 1, "msg" => "User Deleted"]);
    } else {
        echo json_encode(["success" => 0, "msg" => "User Not Found!"]);
    }
} else {
    echo json_encode(["success" => 0, "msg" => "User Not Found!"]);
}


















/* include ('../Databases.php');
include ('./Users.php');

$database = new Database();
$db = $database->getConnection();

$item = new User($db);

$data = json_decode(file_get_contents("php://input"));

$item->user_id = $data->user_id;

if($item->deleteUser()){
    echo json_encode(["success" => 1, "msg" => "User Deleted"]);
} else{
    echo json_encode(["success" => 0, "msg" => "User Not Founded!"]);
        } */
?>