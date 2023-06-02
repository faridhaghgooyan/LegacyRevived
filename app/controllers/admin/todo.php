<?php
use app\models\uploader;
use app\models\todo;
use app\models\dateConverter;

require_once '../app/models/users.php';
require_once '../app/models/uploader.php';
require_once '../app/models/todo.php';
require_once '../app/models/dateConverter.php';

$users_obj = new users();
$uploader = new uploader();
$todo_obj = new todo();
$dateConvertor_obj = new dateConverter();

switch ($action){
    case 'create' :

        $users = $user_obj->customers();
        $due_date_jalali = explode('/', $_POST["due_date_jalali"]);
        $due_date = $dateConvertor_obj->toGregorian($due_date_jalali[0],$due_date_jalali[1],$due_date_jalali[2],$due_date_jalali);
        $due_date = str_replace("/", "-", $due_date);
        $due_date_time = $due_date . ' ' . $_POST["due_time"];

        $todo_obj->create($_POST,$due_date_time);

        break;
    case 'edit' :
        switch ($admin_info->roll_title){
            case 'site_admin':
            case 'admin':
            $users = $users_obj->customers();
                break;
            case 'consultant':

                $users = $users_obj->my_customers($admin_info->id,0,5000);

                break;
        }

        $todo = $todo_obj->edit($_GET['id']);
        break;
    case 'add' :
        switch ($admin_info->roll_title){
            case 'site_admin':
            case 'admin':
                $customers = $users_obj->all_customers();
                break;
            case 'consultant':

                //$customers = $users_obj->my_customers($admin_info->id,0,5000);
                $customers = $users_obj->my_customers_new($admin_info->id);
                break;
        }
        break;
    case 'store' :

        // Convert Jalali Date to Georgian
        $new_date = str_replace('/', '-', $_POST['due_date_jalali']);
        $jDate = explode('-', $new_date);
        $due_date = $dateConvertor_obj->toGregorian($jDate[0],$jDate[1],$jDate[2],$jDate);
        $_POST['due_time'] = $_POST['hour'].':'.$_POST['minute'];
        $due_date = str_replace('/', '-', $due_date) .' '. $_POST['due_time'].':00';

        $todo_obj->store($_POST, $due_date);


        header('location:?c=todo&a=list');
        break;
    case 'update' :
        $new_date = str_replace('/', '-', $_POST['due_date_jalali']);
        $jDate = explode('-', $new_date);
        $due_date = $dateConvertor_obj->toGregorian($jDate[0],$jDate[1],$jDate[2],$jDate);
        $_POST['due_time'] = $_POST['hour'].':'.$_POST['minute'];
        $due_date = str_replace('/', '-', $due_date) .' '. $_POST['due_time'].':00';
        $todo_obj->update($_POST, $due_date,$_POST['todo_id']);
        header('location:?c=todo&a=list');

        break;
    case 'list' :
        $todos = $todo_obj->todo_list($admin_info->id);

        break;
    case 'archive' :
        $todos = $todo_obj->archive($admin_info->id);
        $user = new users();
        $dateConvertor_obj = new dateConverter();
        break;
    case 'delete':
        $todo_obj->delete($_GET['id']);
        header('location:?c=todo&a=list');
        break;
    case 'done':
        $todo_obj->done($_GET['id']);
        header('location:?c=index&a=index#usersChatList'.$_GET['chat_code']);
        break;
}