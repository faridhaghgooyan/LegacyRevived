<?php
use App\Model\{
    User,
    Admin,
    Invoice,
    Draft,
    Chat,
    Todo,
    Reception,
    Payment,
    DateConverter,
    Task,
    Service
};
$usersobj = new User;
$drafts_obj = new Draft;
$chat_obj = new Chat;
$admin_obj = new Admin;
$todo_obj = new Todo;
$reception_obj = new Reception;
$payments_obj = new Payment;
$task_obj = new Task;
$services_obj = new Service;
$invoice_obj = new Invoice;

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
