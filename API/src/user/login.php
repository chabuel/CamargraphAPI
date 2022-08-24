<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization");

require "db_connection.php";

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