<?php
use app\models\dateConverter;
use app\models\payments;
use app\models\todo;
use app\models\reception;
include_once "../config.php";
require_once '../app/models/permissions.php';
require_once '../app/models/admin.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/todo.php';
require_once '../app/models/reception.php';
require_once '../app/models/payments.php';
$todo_obj = new todo();
$reception_obj = new reception();
// Global Functions
$permission = new permissions();
$admin_obj = new admin();
$date_converter = new dateConverter();
$payments_obj = new payments();
// Global Variables
$admin_info = '';
if (isset($_COOKIE['TF-Email'])){
      $admin_info = (object)$admin_obj->login($_COOKIE['TF-Email']);
      $jobs = [];
      $today = date('Y-m-d');
      $jobs = $todo_obj->today_todo($admin_info->id,$today);
//      var_dump($jobs);
//      die();
//    foreach ($todo_obj->todo_list($admin_info->id) as $item){
//        die('hi');
//        $next_day = time() + (86400 * 1);
//        $prev_day = time() - (86400 * 1);
//        $today = strtotime($item["due_date"]);
//        if ($today >= $prev_day and $today <= $next_day){
//            $jobs []=  $item;
//        }
//    }

    switch ($admin_info->roll_title){
        case 'reception':
            $ready_invoices = $reception_obj->ready_customers();
            break;
        case 'finance':
            $new_payments = 0;
            foreach ($payments_obj->payments_list() as $payment){
                if ($payment['accepted_by'] == 0){
                    $new_payments++;
                }
            }
            break;
    }

//    $count = $main->ticketsCount();
//    $payment_count = 0;
//    $loggedUser_id = $user->findByEmail($_COOKIE['TF-Email'])['id'];
//    $loggedUser_pic = $user->findByEmail($_COOKIE['TF-Email'])['pic'];
//    $user_roll = $user->findByEmail($_COOKIE['TF-Email'])['roll'];
//    $user_roll_title = $user->findRoll($user_roll)['title'];
//    $user_roll_faTitle = $user->findRoll($user_roll)['fa_title'];
//    $userName = $user->findByEmail($_COOKIE["TF-Email"])['firstName'].' '.$user->findByEmail($_COOKIE["TF-Email"])['lastName'];
//    $month_list = main::month_list();
//    $services_list = $services_obj->list();
//    $service_req_list = $services_obj->admin_service_req_list();
//    $supporters = $user->supporter_list();
//    $supporterChats = $supporter_obj->todoList($loggedUser_id);
//    $user_amount = $user->find($loggedUser_id)['amount'];
//    $payments = $user->users_payments();
//    $user_obj = new users();
//    $my_customers = $user->customers();
//    $customers = $user->my_customers($loggedUser_id);

    // Admin Users Global Variables
//    switch ($user_roll_title){
//        case 'finance' :
//            $new_payments = $finance_obj->newPayments();
//            break;
//        case 'supporter' :
//            $tasks = $supporter_obj->dr_tasks();
//
//            break;
//        case 'consultant' :
//            include_once "../app/models/kavehSms.php";
//            $sms_obj = new \app\models\kavehSms();
//            $sms_list = $sms_obj->list();
//            $users_list = $user->customers();
//            $doctors = $user->dr_list();
//            break;
//        case 'doctor' :
//            $tasks = $tasks_obj->dr_task_list($loggedUser_id);
//            break;
//        case 'nurse' :
//            $tasks = $supporter_obj->operator_tasks($loggedUser_id);
//
//            break;
//        case 'reception' :
//            $ready_invoices = $reception_obj->ready_customers();
//
//            break;
//    }
}
$controller=@$_GET["c"]?$_GET["c"]:"index";
$action=@$_GET["a"]?$_GET["a"]:"index";
$api=@$_GET["api"]?$_GET["api"]:"index";

require_once "../app/controllers/admin/$controller.php";


if (!isset($admin_info->roll_id)){

    header('location:/admin/login.php');
}

switch (array_keys($_GET)[0]){
    case 'api' :

        $access = $permission->checkPermission($admin_info->roll_id,$api,$action);
        break;
    case 'c':
        $access = $permission->checkPermission($admin_info->roll_id,$controller,$action);

        break;
}

if ($access){
    if ($api != 'index') {
        require_once "../app/controllers/api/$api.php";
    } else if ($controller) {

        if(file_exists("../app/controllers/admin/$controller.php")){
            include_once "../app/view/admin/section/header.php";
            include_once "../app/view/admin/section/scripts.php";
            include_once "../app/view/admin/section/modals.php";

            include_once "../app/view/admin/$controller/$action.php";
            require_once "../app/controllers/admin/$controller.php";
            // Check User Roll
            include_once "../app/view/admin/section/footer.php";
        }
    }
} else {
    header('location:/admin/?c=index&a=index');
}