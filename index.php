<?php

if(!empty($_GET['page'])){
    require_once __DIR__."/web/{$_GET['page']}.php";
}elseif (!empty($_GET['data'])){
    require_once __DIR__."/web/data/{$_GET['data']}.php";
}else{
    require_once __DIR__."/web/batch_detail.php";
}

?>