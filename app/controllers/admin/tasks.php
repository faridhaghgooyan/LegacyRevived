<?php
use App\Model\supporter;
use App\Model\doctor;
use App\Model\nurse;
use App\Model\payment;
use App\Model\dateConverter;
use App\Model\kavehSms;
use App\Model\task;
use App\Model\reception;
use App\Model\Sms;


require_once '../app/models/supporter.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/nurses.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/kavehSms.php';
require_once '../app/models/tasks.php';
require_once '../app/models/reception.php';
require_once '../app/models/admin.php';
require_once '../app/models/sms.php';
require_once '../app/models/payments.php';
// Create Object of Classes
$users_obj = new users();
$doctors_obj = new doctor();
$nurse_obj = new nurse();
$dConverter = new dateConverter();
$supporter = new supporter();
$supporter_obj = new supporter();
$sms_obj = new kavehSms();
$task_obj = new task();
$reception_obj = new reception();
$admin_obj = new admin();
$sms_obj = new Sms();
$payment_obj = new payment();
require_once '../app/models/sms.php';


switch ($action) {
    case 'list':

        break;
    case 'addDrTask':
        $users = $users_obj->customers();
        $doctors = $users_obj->dr_list();
        break;
    case 'nurse_add':
        $users = $users_obj->customers();
        $nurses = $reception_obj->nurses();
        break;
    case 'nurse_create':
            $new_date = str_replace('/', '-', $_POST['due_date_jalali']);
            $jDate = explode('-', $new_date);
            $due_date = $dConverter->toGregorian($jDate[0],$jDate[1],$jDate[2],$jDate);
            $_POST['due_time'] = $_POST['hour'].':'.$_POST['minute'];
            $due_date = str_replace('/', '-', $due_date) .' '. $_POST['due_time'].':00';
            $reception_obj->addNurseDuty($_POST,$due_date);


            header('location:?c=tasks&a=nurse_list');
break;
    case 'nurse_edit' :
        $task = $reception_obj->task_show($_GET['id']);
        $users = $users_obj->customers();
        $nurses = $reception_obj->nurses();
        break;
    case 'task_update':
        $new_date = str_replace('/', '-', $_POST['due_date_jalali']);
        $jDate = explode('-', $new_date);
        $due_date = $dConverter->toGregorian($jDate[0],$jDate[1],$jDate[2],$jDate);
        $_POST['due_time'] = $_POST['hour'].':'.$_POST['minute'];
        $due_date = str_replace('/', '-', $due_date) .' '. $_POST['due_time'].':00';

        $_POST['invoice_unique_id'] = null;
        if (isset($_POST['invoice_id'])){
            $_POST['invoice_unique_id'] = $_POST['invoice_id'];
        }
        $reception_obj->task_update((object)$_POST,$due_date);
        header('location:?c=tasks&a=index');
        break;

    case 'dr_edit':
        $task = $reception_obj->task_show($_GET['id']);
        $users = $users_obj->customers();
        $nurses = $reception_obj->nurses();
        $doctors = $admin_obj->admins('doctor');

        break;
    case 'deleteTask':
        $id = $_GET['id'];
        $reception_obj->deleteTask($id);
        break;












    case 'tasksList' :
        $user = new users();
        $tasks_list = $reception_obj->taskList($admin_info->id);
        var_dump($tasks_list);die();

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

    case 'task_delete':
        $reception_obj->task_delete($_GET['id']);
        header('location:?c=tasks&a=list');
        break;
    case 'drComment':
        $task_id = $_POST['taskID'];
        $comment = $_POST['drComment'];
        $supporter->addDrComment($comment,$task_id);
        break;
    case 'operatorComment' :
        $task = $supporter_obj->findTaskByID($_POST['task_id']);

        $operator_id = $task['operator_id'];

        $customer_id = $task['customer_id'];
        $user = $users_obj->find($customer_id);

        $customer_mobile = $user['mobile'];

        $operator_name = $user['firstName'] . ' ' . $user['lastName'];

        $supporter->operator_done($_POST);
//        $sms_obj->vote_sms($customer_mobile,$_POST['task_id'],$operator_name);
        break;
    case 'dr_add':
        $invoice = $reception_obj->invoice_detail($_GET['id']);
        $users = $users_obj->customers();
        $doctors = $admin_obj->my_admins();
        break;
    case 'dr_create':
        $new_date = str_replace('/', '-', $_POST['due_date_jalali']);
        $jDate = explode('-', $new_date);
        $due_date = $dConverter->toGregorian($jDate[0],$jDate[1],$jDate[2],$jDate);
        $_POST['due_time'] = $_POST['hour'].':'.$_POST['minute'];
        $due_date = str_replace('/', '-', $due_date) .' '. $_POST['due_time'].':00';
        $task_obj->dr_task_create($_POST, $due_date);
        header('location:?c=tasks&a=list');
        break;
    case 'dr_done':
        $task_obj->dr_done($_POST);
        header('location:?c=index&a=index');
        break;
    case 'nurse_list':
        $tasks = $reception_obj->nurse_tasks($admin_info->id);
        break;
    case 'dr_list':
        $tasks = $reception_obj->dr_tasks($admin_info->id);
        break;
    case 'cancelTask':

        $unique_id = $_GET['id'];
        $desc = $_GET['desc'];
        $payment = $payment_obj->find_by_unique_id($unique_id);
        if($payment){
            $result = $payment_obj->change_status($unique_id , '2',$desc);
            var_dump($result);
            if($result){
                header('location:?c=index&a=index');
            }
        }

        break;




}
