<?php

use app\models\dateConverter;
use app\models\payments;


require_once '../app/models/dateConverter.php';
require_once '../app/models/payments.php';

$date_converter = new dateConverter();
$payments_obj = new payments();
switch ($action){
    case 'index':

        break;


}