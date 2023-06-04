<?php
use App\Model\permissions;
use App\Model\dateConverter;
use App\Model\kavehSms;
use App\Model\note;
use App\Model\invoice;
use App\Model\task;
require_once '../app/models/users.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/kavehSms.php';
require_once '../app/models/notes.php';
require_once '../app/models/invoices.php';
require_once '../app/models/tasks.php';
$user_obj = new users();
$dateCovert = new dateConverter();
$invoice_obj = new invoice();
$task_obj = new task();


switch ($action){
    case 'add':
        break;
    case 'create':
        if (isset($_POST['chat_code'])){

            $user = $user_obj->findByCode($_POST['chat_code']);


            $_POST['customer_id'] = $user['id'];
            $_POST['unique_id'] = rand();

            $_POST['from_date'] = $dateCovert->date_convert($_POST['from_date'],'georgian')[0]["date"];
            $_POST['to_date'] = $dateCovert->date_convert($_POST['to_date'],'georgian')[0]["date"];
            $_POST['deadline'] = $invoice_obj->make_deadline();

            $query = $invoice_obj->create((object)$_POST);
            if ($query){
                $result = $task_obj->add_comment((object)$query);
                if ($result){
                    header('location:?c=index&a=index');

                }
            }

        }
        break;
    case 'read':
        $invoice = $invoice_obj->read($_GET['id']);
        break;
    case 'update':
        header('location:?c=notes&a=list');
        break;
    case 'delete':
        $invoice = $invoice_obj->delete($_GET['id']);
        header('location:?c=invoices&a=list');

        break;
    case 'list':
        switch ($admin_info->roll_title){
            case 'admin':
            case 'site_admin':
            case 'consultant':
            case 'finance':
                $invoices = $invoice_obj->list($admin_info->id);

            break;
            case 'reception':
                $invoices = $invoice_obj->complete_list($admin_info->id);

                break;
        }

        break;
    case 'cancel' :
        $invoice = $invoice_obj->read($_GET['id']);
        if ($invoice){
            $res = $invoice_obj->change_status($_GET['id'],invoice::CANCEL_INVOICE);
            if($res){
                header('location:?c=index&a=index');
            }
        }
        break;
    case 'clear' :
        $invoice = $invoice_obj->read($_GET['id']);
        if ($invoice){
            $res = $invoice_obj->change_status($_GET['id'],invoice::CLEAR_INVOICE);
            if($res){
                header('location:?c=index&a=index');
            }
        }
        break;
}
