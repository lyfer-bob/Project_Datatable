<?php
require_once '../../lib/dbconfig.php';
require_once '../../lib/Common.php';

$Common = new Common();

$sql = "";

$result = $conn->query( $sql );
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$data = [];

while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
    $row['itemDetail'] = $Common->expand_items($row['productName'], $row['qty'], $row['unitPrice']);//column items on datatable
//    echo '<pre>';
//    print_r($row);
//    echo '</pre>';
//    exit;
    $data[] = $row;
}

//echo '<pre>';
//print_r($data);
//echo '</pre>';
//exit;

echo json_encode($data);

