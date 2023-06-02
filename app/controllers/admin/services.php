<?php
use app\models\supporter;
use app\models\doctors;
use app\models\nurses;
use app\models\dateConverter;
use app\models\uploader;
use app\models\services;
require_once '../app/models/supporter.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/nurses.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/uploader.php';
require_once '../app/models/services.php';
// Create Object of Classes
$users_obj = new users();
$doctors_obj = new doctors();
$nurse_obj = new nurses();
$dConverter = new dateConverter();
$supporter = new supporter();
$uploader = new uploader();
$services_obj = new services();


switch ($action) {
    case 'add':
        $users = $users_obj->customers();
        $doctors = $users_obj->dr_list();
        break;
    case 'list' :
        $services = $services_obj->list();
        break;
    case 'create':
        $pic = NULL;
        $folder = 'services';
        if ($_FILES["fileToUpload"]["size"] > 0){
            $pic = $uploader->fileUpload($_FILES["fileToUpload"],$folder);
        }

        $services_obj->create($_POST,$pic);
        break;
    case 'read':

        $id = $_GET['id'];
        $service = $services_obj->read($id);

        break;
    case 'update':
        $id = $_GET['id'];
        $pic = '';
        if (isset($services_obj->find($id)["pic"])){
            $pic = $services_obj->find($id)["pic"];
        }
        if ($_FILES["fileToUpload"]["size"] > 0){
            $folder = 'services';
            $pic = $uploader->fileUpload($_FILES["fileToUpload"],$folder);
        }
        $services_obj->update($_POST,$pic,$id);

        break;
    case 'delete':
        $id = $_GET['id'];
        $services_obj->delete($id);
        break;
    case 'doneServiceReq' :
        $services_obj->done_service_req($_GET['id']);
        break;





}
