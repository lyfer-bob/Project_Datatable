<?php
include '../lib/dbconfig.php';
include '../lib/Common.php';

$Common = new Common();

$sql = "SELECT BatchNumber, 
invoice_number AS invoiceNumber,
po_date AS poDate,
pay_amount AS payAmount,
shipping_by AS shippingBy,
shipping_package AS shippingPackage,
tax_name AS taxName,
items->>'$.*.item_code' AS itemCode,
items->>'$.*.ProductName' AS productName,
items->>'$.*.PricePerUnit' AS unitPrice,
items->>'$.*.QTY' AS qty,
items->>'$.*.ProductGroupID' AS productGroupID 
FROM Receive_detail
LIMIT 100 ";
//--WHERE exec_time = '2020-03-06 20:20:22' -- use up from LIMIT

$result = $conn->query( $sql );

$data = [];

while( $row = $result->fetch_array(MYSQLI_ASSOC) ){
    $row['itemDetail'] = $Common->expand_items($row['productName'], $row['qty'], $row['unitPrice']);
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
