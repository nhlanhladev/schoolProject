<?php

 $host = "localhost";
 $username = "root";
 $password = "root";
 $dbname = "community_herb_garden";


    $conn = new mysqli($host, $username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
echo "Connected successfully";

}



// // Create connection




?>