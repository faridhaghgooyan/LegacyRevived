<?php
require_once dirname(__DIR__, 2) . "/Model/tasks.php";
use App\Model\task;

$tasks_obj = new task();

if ($_SERVER['REQUEST_METHOD'] == "GET"){

}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    switch ($_POST['action']){
        case "add_task_comment":
            $result = $tasks_obj->add_task_comment((object)$_POST);

            if ($result){
                echo json_encode(true);
            } else {
                $response = array(
                    "error"=>"مشکلی پیش آمده"
                );
                echo json_encode($response);
            }
            break;

    }
}
