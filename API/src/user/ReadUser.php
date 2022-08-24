<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization");

// require 'db_connection.php';

include ('../Database.php');

$allUsers = mysqli_query($db_connection, "SELECT * FROM users");
if (mysqli_num_rows($allUsers) > 0) {
    $all_users = mysqli_fetch_all($allUsers, MYSQLI_ASSOC);
    echo json_encode(["success" => 1, "users" => $all_users]);
} else {
    echo json_encode(["success" => 0]);
}












/* include ('../Database.php');
include ('./Users.php');

$database = new Database();
$db = $database->getConnection();

$items = new User($db);

$stmt = $items->readUsers();
$itemCount = $stmt->rowCount();


echo json_encode($itemCount);

if($itemCount > 0){
    
    $userArr = array();
    $userArr["body"] = array();
    $userArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        array_push($userArr["body"], $row);
    }
    echo json_encode(["success" => 1, "users" => $userArr]);
}
else{
    echo json_encode(["success" => 0]);
    
}
?> */