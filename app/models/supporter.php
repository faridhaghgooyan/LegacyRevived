<?php
namespace app\models;
if (file_exists('../config.php')){
    require_once '../config.php';
} else {
    require_once '../../config.php';
}

class supporter {
    public function __construct(){
        global $db;
        global $table;
        $this->db = $db;
        $table = 'ticket';
    }

    public function addDrDuty($data,$gDate) {
        $creator_id = $data["creator_id"];
        $taskID = rand();
        $customer_id = $data["customer_id"];
        $for_who = $data["adminuser_id"];
        $title = $data["title"];

        $this->db->query("
        insert into tasks
            (creator,task_id,customer_id,for_who,title,due_date_time)
            values ('$creator_id','$taskID','$customer_id','$for_who','$title','$gDate')
            ");
        // Increase Admin User Due Count
        $this->db->query("update users set jobs = jobs + 1 where id = $creator_id");
    }
    public function addDrComment($comment,$task_id){
        $this->db->query("update tasks set drComment='$comment' where task_id='$task_id'");
    }
    public function taskList($creator_id){
        $query = $this->db->query("select * from tasks where creator=$creator_id and has_invoice is null order by due_date asc  ");
        return $query->fetchAll();
    }
    public function todoList($creator){
        $query = $this->db->query("select * from tasks where creator=$creator order by id desc");
        return $query->fetchAll();
    }
    public function deleteTask($id){
        $query = $this->db->query("select creator from tasks where id=$id");
        $user = $query->fetchAll();
        $user_id = $user[0]["creator"];
        $this->db->query("delete from tasks where id=$id");
        $this->db->query("update users set jobs = jobs - 1 where id = $user_id");
    }

    public function findTask($taskID){
        $query = $this->db->query("select * from tasks where task_id=$taskID");
        return $query->fetch();
    }
    public function findTaskByID($taskID){
        $query = $this->db->query("select * from tasks where id=$taskID");
        return $query->fetch();
    }
    public function updateTask($data,$jDate,$gDate,$id) {

        $creator_id = $data["creator_id"];
        $taskID = $data["taskID"];
        $title = $data["title"];
        $creator = $data["creator"];
        $user_id = $data["customer_id"];
        $comment = $data["comment"];
        $roll_id = 3;

        $this->db->query("
            update tasks set
                          creator = '$creator_id',
                          task_id = '$taskID',
                          title = '$title',
                          creator = '$creator',
                          roll_id = '$roll_id',
                          customer_id = '$user_id',
                          comment = '$comment',
                          due_date_jalali = '$jDate',
                          due_date = '$gDate'
                        where id=$id
                          ");
    }
    public function createInvoice($data,$creator_id){
        $task_id = $data['taskID'];
        $unique_id = rand();
        $price = $data['price'];
        $status = 0;
        $find_customer = $this->db->query("select customer_id from tasks where task_id=$task_id");
        $customer_id = $find_customer->fetch()["customer_id"];
        $this->db->query("insert into invoices (customer_id,creator_id,task_id,unique_id,price,status) values ('$customer_id','$creator_id','$task_id','$unique_id','$price','$status')");
        $this->db->query("update tasks set has_invoice = $unique_id where task_id=$task_id");
    }
    public function invoicesList($creator_id){
        $query = $this->db->query("select * from invoices where creator_id=$creator_id order by id asc  ");
        return $query->fetchAll();
    }
    public function deleteInvoice($id){
        $query = $this->db->query("select task_id from invoices where id =$id");
        $task_id = $query->fetch()[0];
        echo $task_id;
        $this->db->query("delete from invoices where id=$id");
        $this->db->query("update tasks set has_invoice = NULL where task_id=$task_id");
    }
    public function addNurseDuty($data,$gDate) {
        $creator_id = $data["creator_id"];
        $taskID = rand();
        $customer_id = $data["customer_id"];
        $operator_id = $data["operator_id"];
        $creator_comment = $data["creator_comment"];
        $title = $data["title"];


        $this->db->query("
        insert into tasks
            (creator,task_id,customer_id,operator_id,creator_comment,title,due_date_time)
            values ('$creator_id','$taskID','$customer_id','$operator_id','$creator_comment','$title','$gDate')
            ");
        // Increase Admin User Due Count
        $this->db->query("update users set jobs = jobs + 1 where id = $creator_id");
    }
    public function read($id){
        $query = $this->db->query("select * from tasks where id=$id");
        return $query->fetch();
    }
    public function operator_tasks($id){
        $query = $this->db->query("select * from tasks where operator_id = $id and has_done = 0 order by id desc");
        return $query->fetchAll();
    }
    public function operator_done($data){

        $operator_comment = $data['operator_comment'];
        $task_id = $data['task_id'];
      
        $this->db->query("update tasks set operator_comment = '$operator_comment' , has_done = 1 , has_vote = 0 where id = '$task_id'");
    }
    public function dr_tasks(): array
    {
        $query = $this->db->query("
            SELECT tasks.* , users.*
            FROM tasks
            left JOIN users on users.id = tasks.operator_id
            order by tasks.id desc
        ");
        return $query->fetchAll();
    }
}