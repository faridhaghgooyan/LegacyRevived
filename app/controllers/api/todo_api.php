<?php
require_once dirname(__DIR__,2)."/models/uploader.php";
require_once dirname(__DIR__,2)."/models/todo.php";
require_once dirname(__DIR__,2)."/models/users.php";
require_once dirname(__DIR__,2)."/models/dateConverter.php";
use app\models\todo;
use app\models\uploader;
use app\models\dateConverter;
$todo_obj = new todo();
$user_obj = new users();
$uploader_obj = new uploader();
$dateConverter = new dateConverter();
if ($_SERVER['REQUEST_METHOD'] == "GET"){

}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    switch ($_POST['action']){
        case "new":
            $now = date('Y-m-d H:i:sa');
            $new = $todo_obj->read_to_show($_POST['admin_id'],$now);

            if ($new){
                $new['fa_time'] = $dateConverter->date_convert($new['due_date'],'jalali')[0]['time'];
                $new['fa_date'] = $dateConverter->date_convert($new['due_date'],'jalali')[0]['date'];
                echo json_encode($new);

            } else {
                echo json_encode('');

            }
            break;

    }
}
