<?php

 $dbhost = "localhost";
 $dbuser = "webservicedb";
 $dbpass = "Webservice#!2020";
 $db = "2jde";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
//checkConnection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$orauser = "happy";
$orapass = "Happy#2020";


/* Database config */
$oradb = "(DESCRIPTION=
    (ADDRESS=
      (PROTOCOL=TCP)
      (HOST=172.16.1.144)
      (PORT=1521)
    )
    (CONNECT_DATA=
      (SERVER=default)
      (SERVICE_NAME=JDE)
    )
  )";
  
  /* End config */
putenv("NLS_LANG=AMERICAN_AMERICA.WE8ISO8859P15");
//putenv("NLS_LANG=AMERICAN_AMERICA.AL32UTF8");
$oraconn = oci_connect($orauser,$orapass,$oradb);
if (!$oraconn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

?>