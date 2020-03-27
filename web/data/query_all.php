<?php
require_once '../../lib/dbconfig.php';
require_once '../../lib/Common.php';

$Common = new Common();


$type = $_GET['test'];
$date = $_GET['test'];
$batch = $_GET['test'];
if ( isset($type)) {
    if ( $type  == 'test'){
        $typedraw = 'test';
    }
    else if ( $type == 'test') {
        $typedraw = 'test';
    }
    else if( $type== 'test') {
        $typedraw = 'test';
    }
}
if ($type == 'inv' or $type == 'rec' ) { //DrawTable TaxInvoice_detail and Receive_detail
    $sql = "";
}
//check table
else { //DrawTable CrediteNote_detail
    $sql = "test";
}
$result = $conn->query( $sql );

$data = [];

while( $row = $result->fetch_array(MYSQLI_ASSOC) ){ //fetch Data
    $row['itemDetail'] = $Common->expand_items($row['productName'], $row['qty'], $row['unitPrice']); //column item on datatable
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

