<?php

include "ais.php";

$asin = $_POST['asin'];
if (!ctype_alnum($asin))
{
    die('invalid_input');
}


$AIS = new AIS('downloads');

$success = $AIS->downloadImages($asin);

if($success){
    echo 'success';
}else{
    echo 'failed';
}