<?php
include '../lib/dbconfig.php';
include '../lib/Common.php';

$Common = new Common();

$sql = "SELECT  CrediteNote_detail.BatchNumber, 
CrediteNote_detail.invoice_number AS invoiceNumber,
CrediteNote_detail.cn_number AS cnNumber,
CrediteNote_detail.total,
CrediteNote_detail.cn_type AS cnType,
CrediteNote_detail.remark,
CrediteNote_detail.customer_id,
CrediteNote_detail.items->>'$.*.item_code' AS itemCode,
CrediteNote_detail.items->>'$.*.ProductName' AS productName,
CrediteNote_detail.items->>'$.*.PricePerUnit' AS unitPrice,
CrediteNote_detail.items->>'$.*.QTY' AS qty,
CrediteNote_detail.items->>'$.*.ProductGroupID' AS productGroupID 
FROM CrediteNote_detail 
WHERE DataOf = '".$_GET['date']."'";

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

