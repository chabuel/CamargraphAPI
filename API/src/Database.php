<?php
        $host = "eu-cdbr-west-02.cleardb.net";
        $username = "bf41c4382ba64d";
        $password = "3d66820f";
        $database_name = "heroku_e4f2db4d9585338";

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