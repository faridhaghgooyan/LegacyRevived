<?php
use App\Model\doctor;
use App\Model\uploader;
use App\Model\dateConverter;
use App\Model\finance;
use App\Model\chat;
require_once '../app/models/admin.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/uploader.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/finance.php';
require_once '../app/models/chat.php';
require_once '../app/models/permissions.php';
$admin_obj = new admin();
$user_obj = new users();
$dr_obj = new doctor();
$uploader = new uploader();
$permission_obj = new permissions();
$finance_obj = new finance();
$chat_obj = new chat();


switch ($action){
    case 'check_number':
        
        break;




}