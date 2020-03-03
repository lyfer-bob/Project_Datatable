<?php
include 'lib/dbconfig.php';

$sql = "SELECT * FROM pre_orders WHERE is_payment ='ชำระเงินแล้ว' AND inv_date >= '2020-01-01 00:00:00' AND inv_date <= '2020-01-31 23:59:59'";
$result = $conn->query( $sql );
while( $row = $result->fetch_array(MYSQLI_BOTH) ){
    // output data of each row
   
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    
    }
$conn->close();

?>