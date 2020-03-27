<?php

 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "datatable";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
//checkConnection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>