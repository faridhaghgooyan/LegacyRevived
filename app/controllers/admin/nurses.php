<?php
use app\models\nurses;
use app\models\dateConverter;

require_once '../app/models/nurses.php';
require_once '../app/models/users.php';
require_once '../app/models/dateConverter.php';

$users_obj = new users();
$nurses_obj = new nurses();
$dConverter = new dateConverter();

switch ($action){
    case 'tasks_list':
        $tasks = $nurses_obj->tasks_list($admin_info->id);
        break;
    case 'old_tasks':
        $tasks = $nurses_obj->old_tasks($admin_info->id);
        break;
    case 'addComment':
        $task_id = $_POST['taskID'];
        $comment = $_POST['drComment'];
        $nurses_obj->addComment($comment,$task_id);
        break;
    case 'add':
        $users = $users_obj->customers();
        $nurses = $nurses_obj->list();
    break;
    case 'create':
        $jDate = explode('/',$_POST['due_date_jalali']);
        $jDate_new = $_POST['due_date_jalali'];
        $gDate = $dConverter->toGregorian($jDate[0], $jDate[1], $jDate[2], true);
        $nurses_obj->create($_POST,$jDate_new,$gDate);
    break;
    case 'read':
    break;
    case 'update':
    break;
    case 'delete':
    break;
}