<?php
use app\models\supporter;
use app\models\doctors;
use app\models\nurses;
use app\models\dateConverter;
require_once '../app/models/supporter.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/nurses.php';
require_once '../app/models/dateConverter.php';
// Create Object of Classes
$users_obj = new users();
$doctors_obj = new doctors();
$nurse_obj = new nurses();
$dConverter = new dateConverter();
$supporter = new supporter();


switch ($action) {
    case 'addSupporterJob':
        $users = $users_obj->customers();
        $supporters = $users_obj->supporter_list();
        break;
    case 'storeSupporterJob' :
        $jDate = explode('/',$_POST['due_date_jalali']);
        $jDate_new = $_POST['due_date_jalali'];
        $gDate = $dConverter->toGregorian($jDate[0], $jDate[1], $jDate[2], true);

        $supporter->addDrDuty($_POST,$jDate_new,$gDate);

        break;
    case 'supporterTasksList' :
        $user = new users();
        $tasks_list = $supporter->taskList($admin_info->id);
        break;
    case 'readTask':
        $users_obj = new users();

        $doctors = $users_obj->dr_list();
        $nurses = $nurse_obj->list();
        $users = $users_obj->customers();
        $id = $_GET['id'];
        $task = $supporter->read($id);
        $supporters = $users_obj->supporter_list();


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
    case 'read':

        break;
    case 'update':

        break;

    case 'createInvoice':

        $supporter->createInvoice($_POST,$admin_info->id);
        break;
    case 'invoicesList':
        $users_obj = new users();
        $supporter = new supporter();
        $invoices = $supporter->invoicesList($admin_info->id);
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
