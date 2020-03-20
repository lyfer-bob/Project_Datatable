<?php
require_once '../../lib/dbconfig.php';
require_once '../../lib/Common.php';

$Common = new Common();

$table = $_GET['type'];
//check tablename
if ( isset($table)) {
    if ( $table  == 'inv'){
        $tabledraw = 'TaxInvoice_detail';
    }
    else if ( $table == 'rec') {
        $tabledraw = 'Receive_detail';
    }
    else if(  $table == 'cre') {
        $tabledraw = 'CrediteNote_detail';
    }
}
$sql = "SELECT DISTINCT BatchNumber
FROM $tabledraw
WHERE DataOf = '" . $_GET['date'] ."'" ;
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

