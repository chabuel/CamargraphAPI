<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization");

require 'db_connection.php';

$lastPost = mysqli_query($db_conn, "SELECT post_id, post_fr_title, post_en_title, post_fr_view, post_en_view, post_fr_desc, post_en_desc, post_date, post_img FROM posts ORDER BY post_id DESC LIMIT 1");

if (mysqli_num_rows($lastPost) > 0) {
    $last_post = mysqli_fetch_all($lastPost, MYSQLI_ASSOC);
    echo json_encode(["success" => 1, "posts" => $last_post]);
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