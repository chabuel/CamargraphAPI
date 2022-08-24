<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization");

include ('../Database.php');

$data = json_decode(file_get_contents("php://input"));

if(isset($data->user_name)
	&& isset($data->user_mail) 
	&& isset($data->user_id)
    && isset($data->user_pwd) 
	&& !empty(trim($data->user_name))
	&& !empty(trim($data->user_email))
	&& !empty(trim($data->user_id))
    && !empty(trim($data->user_pwd))
	){
		
	$username = mysqli_real_escape_string($db_connection, trim($data->user_name));
	$usermail = mysqli_real_escape_string($db_connection, trim($data->user_mail));
	$userid = mysqli_real_escape_string($db_connection, trim($data->user_id));
    $userpwd = mysqli_real_escape_string($db_connection, trim($data->user_pwd));

  $updateuser = mysqli_query($db_connection,"UPDATE users set user_name ='$username', user_mail ='$usermail', user_pwd ='$usermail' WHERE user_id='$userid'");

	if($updateuser){
		echo json_encode(["success"=>true]);
		return;
    }else{
        echo json_encode(["success"=>false,"msg"=>"Server Problem. Please Try Again"]);
		return;
    } 

} else{
    echo json_encode(["success"=>false,"msg"=>"Please fill all the required fields!"]);
	return;
}
?>




















/* include ('../Database.php');
include ('./Users.php');

    $database = new Database();
    $db = $database->getConnection();
    
    $item = new User($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->user_id = $data->user_id;
    
    // User values
    $item->user_name = $data->user_name;
    $item->user_mail = $data->user_mail;
    $item->user_pwd = $data->user_pwd;
    
    if($item->updateUser()){
        echo json_encode(["success" => 1, "msg" => "User Updated."]);
    } else{
        echo json_encode(["success" => 0, "msg" => "User Not Updated!"]);
        } */
?>