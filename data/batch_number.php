<?php
include '../lib/dbconfig.php';
include '../lib/Common.php';

$Common = new Common();

$sql = "SELECT DISTINCT BatchNumber
FROM TaxInvoice_detail

WHERE pay_by = 'บัตรเครดิต'";
$result = $conn->query( $sql );

$data = [];

while( $row = $result->fetch_array(MYSQLI_ASSOC) ){

//    echo '<pre>';
//    print_r($row);
//    echo '</pre>';
//    exit;
    $data[] = $row["BatchNumber"];
}


//echo '<pre>';
//print_r($data);
//echo '</pre>';
//exit;
header('Content-Type: application/json');
echo json_encode($data);

