<?php
use app\models\drafts;
use app\models\chat;
use app\models\todo;
use app\models\reception;
use app\models\payments;
use app\models\dateConverter;
use app\models\tasks;
use app\models\services;
use app\models\invoices;
require_once '../app/models/users.php';
require_once '../app/models/invoices.php';
require_once '../app/models/drafts.php';
require_once '../app/models/chat.php';
require_once '../app/models/todo.php';
require_once '../app/models/reception.php';
require_once '../app/models/payments.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/tasks.php';
require_once '../app/models/services.php';
$usersobj = new users();
$drafts_obj = new drafts();
$chat_obj = new chat();
$admin_obj = new admin();
$todo_obj = new todo();
$reception_obj = new reception();
$payments_obj = new payments();
$task_obj = new tasks();
$services_obj = new services();
$invoice_obj = new invoices();

switch ($action){
    case 'index':
        switch ($admin_info->roll_title){
            case 'admin':
                $admins = $admin_obj->my_admins();
                $users = $admin_obj->my_customers();
                break;
            case 'site_admin':
                $chat_list = $chat_obj->site_admin_chats();

                break;
            case 'consultant':
                $contacts = $chat_obj->chat_list($admin_info->id);
                break;
            case 'reception':
                $ready_invoices = $reception_obj->ready_customers();
                $user_requests = $services_obj->index();
                break;
            case 'finance':
                $payments = $payments_obj->payments_list();
                $cancel_invoices = $invoice_obj->cancel_invoices();
                $dConverter = new dateConverter();
                break;
            case 'doctor':
                $tasks = $task_obj->dr_task_list($admin_info->id);
                $dConverter = new dateConverter();

                break;
            case 'supporter':
                $tasks = $task_obj->dr_task_list($admin_info->id);
                $nurse_tasks_list = $task_obj->nurse_tasks_list();
                $dConverter = new dateConverter();
                break;

            case 'nurse':
                $tasks = $task_obj->my_tasks($admin_info->id);

                $dateConvertor_obj = new dateConverter();
                break;
        }
        break;

}
