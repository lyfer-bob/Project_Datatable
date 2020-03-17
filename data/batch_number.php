<?php
include '../lib/dbconfig.php';
include '../lib/Common.php';

$Common = new Common();

$table = $_GET['type'];

if ( isset($table)) {
    if ( $table  == 'inv'){
        $tabledraw = 'TaxInvoice_detail';
    }
    else if ( $_GET['type'] == 'rec') {
        $tabledraw = 'Receive_detail';
    }
    else if( $_GET['type'] == 'cre') {
        $tabledraw = 'CrediteNote_detail';
    }
}
$sql = "SELECT DISTINCT BatchNumber
FROM $tabledraw
WHERE DataOf = '" . $_GET['date'] ."'" ;
//WHERE pay_by = 'บัตรเครดิต'";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

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

