<?php
use app\models\supporter;
use app\models\doctors;
use app\models\nurses;
use app\models\dateConverter;
use app\models\uploader;
use app\models\services;
use app\models\Sms;
require_once '../app/models/supporter.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/nurses.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/uploader.php';
require_once '../app/models/sms.php';

require_once '../app/models/services.php';
// Create Object of Classes
$users_obj = new users();
$doctors_obj = new doctors();
$nurse_obj = new nurses();
$dConverter = new dateConverter();
$supporter = new supporter();
$uploader = new uploader();
$services_obj = new services();
$sms_obj = new Sms();


switch ($action) {
    case 'service_accept':
        $services_obj->done_service_req($_GET['id']);
        $service = (object)$services_obj->findReq($_GET['id']);
        $service_name = str_replace(" ","_",$service->title);
        $user = $users_obj->find($service->customer_id);
        $mobile = $user['mobile'];
        $username = str_replace(" ","_",$user['lastName']);
        $sms_obj->sendNow("$mobile","serviceAccept","$username","$service_name",'',);
        header('location:?c=index&a=index');
        break;
        case 'service_cancel':
            $services_obj->modify([
                "id" => $_GET['id'],
                "status" => 0
            ]);
                $services_obj->done_service_req($_GET['id']);
                $service = (object)$services_obj->findReq($_GET['id']);
                $service_name = str_replace(" ","_",$service->title);
                $user = $users_obj->find($service->customer_id);
                $mobile = $user['mobile'];
                $username = str_replace(" ","_",$user['lastName']);
                $sms_obj->sendNow("$mobile","serviceCancel","$username","$service_name",'',);
            header('location:?c=index&a=index');
        break;







}
