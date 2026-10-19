<?php
        $host = "";
        $username = "";
        $password = "";
        $database_name = "";

        $db_connection = mysqli_connect($host, $username, $password, $database_name,);

        if(mysqli_connect_errno()) {
            echo "Connection Failed".mysqli_connect_error();
            exit;
        }
        else {
            mysqli_query($db_connection,"set names utf8");
        }


        /*
<
    }*/
     
?>
