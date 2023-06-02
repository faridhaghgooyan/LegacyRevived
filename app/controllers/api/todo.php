<?php
use app\models\doctors;
use app\models\dateConverter;
use app\models\todo;
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/todo.php';
$user_obj = new users();
$dr_obj = new doctors();
$todo_obj = new todo();
$date_covert = new dateConverter();
date_default_timezone_set('Asia/Tehran');

switch ($action){

    case 'newTodo':

        $todos = [];
        $now_time =  date('Y-m-d H:i:s');
        foreach ($todo_obj->newTodo($admin_info->id) as $item){

            if (strtotime($item['due_date']) <= strtotime($now_time)) {
                $item['userName'] = $item['first_name'].' '.$item['last_name'];
                $item['jalali_date'] = $date_covert->dateConvert($item['due_date'])[0]['date'];
                $item['jalali_time'] = $date_covert->dateConvert($item['due_date'])[0]['time'];
                $todos[] = $item;
            }
        }
        echo json_encode($todos);
        break;
        case 'todoShow':
        $todo_obj->todoShow($_GET['id']);
        break;
    case 'cities':
        $province_id = $_GET["id"];
        echo json_encode($user_obj->cities($province_id));
//        $province_id = $_POST["province_id"];
//        $cities = $obj->cities($province_id);
        break;
    case 'chatFiles' :
        $user_id = $_GET['id'];
        echo json_encode($user_obj->userChatFiles($user_id));
        break;
    case 'consultant':
        $consultants = $user_obj->consultant_list();
        json_encode($consultants);
        break;
    case 'getComment' :
        if ($user->getComments($_GET['id'])){
            echo json_encode($user->getComments($_GET['id']));
        }
        break;
    case 'todoList':
        $creator_id = $_GET['id'];
        echo json_encode($todo_obj->todo_list($creator_id));
        break;


}