<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require "Database.php";

$email    = $_REQUEST['user_name'];
$password = md5($_REQUEST['user_pwd']);

try {
    $sql = "SELECT * FROM users WHERE (user_name='$email') AND user_pwd='$password'";

    $q = $conn->query($sql);
    $q->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
// while ($row = $q->fetch()) :
//     echo htmlspecialchars($row['email']);
// endwhile;
?>