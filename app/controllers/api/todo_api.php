<?php
require_once dirname(__DIR__, 2) . "/Model/uploader.php";
require_once dirname(__DIR__, 2) . "/Model/todo.php";
require_once dirname(__DIR__, 2) . "/Model/users.php";
require_once dirname(__DIR__, 2) . "/Model/dateConverter.php";
use App\Model\todo;
use App\Model\uploader;
use App\Model\dateConverter;
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
