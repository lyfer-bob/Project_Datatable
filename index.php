<?php

if(empty($_GET['page'])){
    require_once __DIR__."/web/batch_detail.php";
}else{
    require_once __DIR__."/web/{$_GET['page']}.php";
}

?>