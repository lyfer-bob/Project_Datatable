<?php
require_once '../../lib/dbconfig.php';
require_once '../../lib/Common.php';

$Common = new Common();


$type = $_GET['type'];
$date = $_GET['date'];
$batch = $_GET['batch'];
if ( isset($type)) {
    if ( $type  == 'inv'){
        $typedraw = 'TaxInvoice_detail';
    }
    else if ( $type == 'rec') {
        $typedraw = 'Receive_detail';
    }
    else if( $type== 'cre') {
        $typedraw = 'CrediteNote_detail';
    }
}
if ($type == 'inv' or $type == 'rec' ) { //DrawTable TaxInvoice_detail and Receive_detail
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
FROM $typedraw
WHERE  DataOf = " . "'" . $date . "'" . "  AND BatchNumber = " . "'" . $batch . "'" ;

}
//check table
else { //DrawTable CrediteNote_detail
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
WHERE  DataOf = '" .$date. "'" ."  AND BatchNumber = '" .$batch. "'" ;
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

