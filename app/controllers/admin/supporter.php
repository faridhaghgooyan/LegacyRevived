<?php
use App\Model\supporter;
use App\Model\doctor;
use App\Model\nurse;
use App\Model\dateConverter;
require_once '../app/models/supporter.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/nurses.php';
require_once '../app/models/dateConverter.php';
// Create Object of Classes
$users_obj = new users();
$doctors_obj = new doctor();
$nurse_obj = new nurse();
$dConverter = new dateConverter();
$supporter = new supporter();


switch ($action) {
    case 'addDrTask':
            $users = $users_obj->customers();
            $doctors = $users_obj->dr_list();
        break;
    case 'addNurseTask':
        $users = $users_obj->customers();
        $nurses = $nurse_obj->list();
        break;
    case 'tasksList' :
        $user = new users();
        $tasks_list = $supporter->taskList($loggedUser_id);
        break;
    case 'readTask':
        $users_obj = new users();

        $doctors = $users_obj->dr_list();
        $nurses = $nurse_obj->list();
        $users = $users_obj->customers();
        $id = $_GET['id'];
        $task = $supporter->read($id);

        break;
    case 'updateTask':
        $id = $_GET['id'];
        $jDate = explode('/',$_POST['due_date_jalali']);
        $jDate_new = $_POST['due_date_jalali'];
        $gDate = $dConverter->toGregorian($jDate[0], $jDate[1], $jDate[2], true);

        $supporter->updateTask($_POST,$jDate_new,$gDate,$id);

        break;
    case 'deleteTask':
        $id = $_GET['id'];
        $supporter->deleteTask($id);
        break;
    case 'create' :
        $jDate = explode('/',$_POST['due_date_jalali']);
        $jDate_new = $_POST['due_date_jalali'];
        $gDate = $dConverter->toGregorian($jDate[0], $jDate[1], $jDate[2], true);

        $supporter->addDrDuty($_POST,$jDate_new,$gDate);

        break;
    case 'read':

        break;
    case 'update':

        break;

    case 'createInvoice':

        $supporter->createInvoice($_POST,$loggedUser_id);
        break;
    case 'invoicesList':
        $users_obj = new users();
        $supporter = new supporter();
        $invoices = $supporter->invoicesList($loggedUser_id);
        break;
    case 'deleteInvoice':
        $id = $_GET['id'];
        $supporter->deleteInvoice($id);
        break;

    case 'delete':

        break;
    case 'drComment':
        $task_id = $_POST['taskID'];
        $comment = $_POST['drComment'];
        $supporter->addDrComment($comment,$task_id);
        break;

}
