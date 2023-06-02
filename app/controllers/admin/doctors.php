<?php
use app\models\doctors;
use app\models\uploader;
require_once '../app/models/doctors.php';
require_once '../app/models/uploader.php';
$doctor_obj = new doctors();
$uploader = new uploader();
switch ($action){
    case 'tasks_list':
        $tasks = $doctor_obj->tasks_list($admin_info->id);
        break;
    case 'old_tasks':
        $tasks = $doctor_obj->old_tasks($admin_info->id);
        break;
    case 'addComment':
        $task_id = $_POST['taskID'];
        $comment = $_POST['drComment'];
        $doctor_obj->addComment($comment,$task_id);
        break;
    case 'list':
        $doctors = $doctor_obj->dr_list();
        break;
    case 'add':
        break;
    case 'store':
        $data = $_POST['addDr'];
        $pic = $_FILES["profilepic"];
        $path = uploader::upload($pic);
        $doctors = $doctor_obj->dr_store($data,$path);
//        var_dump();
        break;
    case 'edit':
        $id = $_GET['id'];
        $doctor = $doctor_obj->dr_edit($id);
        break;
    case 'update':
        $id = $_POST['addDr']['id'];
        $doctor = $doctor_obj->dr_edit($id);
        $old_pic = $doctor['pic'];
        $data = $_POST['addDr'];
        $pic = $_FILES["profilepic"];
//        var_dump($old_pic);
//        var_dump($pic);die();
        if ($pic["size"] === 0){
            $path = $old_pic;
        } else {
            $path = uploader::upload($pic);
        }
        $doctors = $doctor_obj->dr_update($data,$path);
        break;
    case 'destroy':
        echo 'ok';
        $id = $_GET['id'];
        $doctors = $doctor_obj->dr_destroy($id);
        break;
}

//var_dump('this'.$doctors);