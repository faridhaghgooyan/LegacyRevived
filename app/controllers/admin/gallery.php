<?php

use App\Model\user;
use App\Model\gallery;
use App\Model\dateConverter;

require_once '../app/models/users.php';
require_once '../app/models/gallery.php';
require_once '../app/models/dateConverter.php';

$gallery_obj = new Gallery();
$dconverter = new dateConverter();
$uses_obj = new users();

switch ($action) {
    case 'index':
        $chat_code = isset($_POST['chat_code']) && $_POST['chat_code'] == 0 || !isset($_POST['chat_code']) ? '' : $_POST['chat_code'];

        $galleries = $gallery_obj->index($admin_info->id,$chat_code);
//        var_dump($galleries);
//        die();

        $customers = $uses_obj->my_customers($admin_info->id,0,5000);
        break;



}