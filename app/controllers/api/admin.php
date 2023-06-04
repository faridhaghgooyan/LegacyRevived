<?php
use App\Model\chat;
use App\Model\uploader;
use App\Model\service;
require_once '../app/models/uploader.php';
require_once '../app/models/chat.php';
require_once '../app/models/users.php';
require_once '../app/models/services.php';
require_once '../app/models/admin.php';
$uploader = new uploader();
$chat = new chat();
$user = new users();
$services_obj = new service();
$admin_obj = new admin();
switch ($action){
    case 'admin_check_number':
        $admin = $admin_obj->check_number($_GET['phone']);
        echo json_encode($admin);
        break;
        
        

}