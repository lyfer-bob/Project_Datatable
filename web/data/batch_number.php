<?php
require_once '../../lib/dbconfig.php';
require_once '../../lib/Common.php';

$Common = new Common();

$table = $_GET['type'];
//check tablename
if ( isset($table)) {
    if ( $table  == 'test'){
        $tabledraw = 'test';
    }
    else if ( $table == 'test') {
        $tabledraw = 'test';
    }
    else if(  $table == 'test') {
        $tabledraw = 'test';
    }
}
$sql = "";
$data = [];

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

//    echo '<pre>';
//    print_r($row);
//    echo '</pre>';
//    exit;
    $data[] = $row["test"];
}


//echo '<pre>';
//print_r($data);
//echo '</pre>';
//exit;
header('Content-Type: application/json');
echo json_encode($data);

