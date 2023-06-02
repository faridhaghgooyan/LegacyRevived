<?php
namespace app\models;
require_once dirname(__DIR__, 3)."/config.php";
class nurses{
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function tasks_list($nurse_id){
        $query = $this->db->query("
        select tasks.* , users.firstName , users.lastName, users.mobile , users.pic
from tasks 
LEFT JOIN users on users.id = tasks.customer_id
where operator_id = $nurse_id  order by due_date_time asc
         ");
        return $query->fetchAll();
    }
    public function old_tasks($admin_id){
        $query = $this->db->query("select * from tasks where operator_id = $admin_id  order by id desc");
        return $query->fetchAll();
    }
    public function addComment($comment,$task_id){
        $this->db->query("update tasks set drComment='$comment' where task_id='$task_id'");
    }


    public function create($data,$jDate,$gDate) {
        $taskID = rand();
        $title = $data["title"];
        $adminuser_id = $data["adminuser_id"];
        $user_id = $data["customer_id"];
        $comment = $data["comment"];
        $roll_id = 7;

        $this->db->query("insert into tasks(task_id,title,adminuser_id,roll_id,customer_id,comment,due_date_jalali,due_date) values ('$taskID','$title','$adminuser_id','$roll_id','$user_id','$comment','$jDate','$gDate')");
    }
    public function list(){
        $query = $this->db->query("select * from users where roll=7");
        $result = $query->fetchAll();
        return $result;
    }
}