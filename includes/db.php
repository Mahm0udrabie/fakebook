<?php
//database connection
 $db['db_host']="localhost";
 $db['db_user']="mahmoud";
 $db['db_pass']="mahmoud.rabie";
 $db['db_name']="cms_v2";
 //$db  array();
 foreach($db as $key => $value )
 {
 define(strtoupper($key), $value); //strtoupper() to make characters uppercase
 } 
 
 $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
 if(!$connection)
 {
 die("not connected". mysqli_error($connection) );
 }


?>

