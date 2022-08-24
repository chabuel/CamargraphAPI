<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Api-Key, X-Requested-With, Content-Type, Accept, Authorization");

function get_data_fr()  
 {  
    require 'db_connection.php';

    $lastPost = mysqli_query($db_conn, "SELECT post_id, post_fr_title, post_fr_view, post_fr_desc, post_date, post_img FROM posts ORDER BY post_id DESC LIMIT 1");  
      $post_data = array();  
      while($row = mysqli_fetch_array($lastPost))  
      {  
           $post_data[] = array(  
                'post_id'               =>     $row["post_id"],  
                'title'          =>     $row["post_fr_title"],  
                'overview'     =>     $row["post_fr_view"],
                'description'  =>     $row["post_fr_desc"],  
                'date'          =>     $row["post_date"],  
                'image'     =>     $row["post_img"]    
           );  
      }  
      return json_encode($post_data);  
 }  
    $file_name = 'fr_translation' . ".json";  
    if(file_put_contents($file_name, get_data_fr()))  
    {  
        echo $file_name . ' File created';  
    }  
    else  
    {  
        echo 'There is some error';  
    }  

    function get_data_en()  
    {  
       require 'db_connection.php';
   
       $lastPost = mysqli_query($db_conn, "SELECT post_id, post_en_title, post_en_view, post_en_desc, post_date, post_img FROM posts ORDER BY post_id DESC LIMIT 1");  
         $post_data = array();  
         while($row = mysqli_fetch_array($lastPost))  
         {  
              $post_data[] = array(  
                   'post_id'               =>     $row["post_id"],  
                   'title'          =>     $row["post_en_title"],  
                   'overview'     =>     $row["post_en_view"],
                   'description'  =>     $row["post_en_desc"],  
                   'date'          =>     $row["post_date"],  
                   'image'     =>     $row["post_img"]    
              );  
         }  
         return json_encode($post_data);  
    }  
       $file_name = 'en_translation' . ".json";  
       if(file_put_contents($file_name, get_data_en()))  
       {  
           echo $file_name . ' File created';  
       }  
       else  
       {  
           echo 'There is some error';  
       }

       
 ?>



