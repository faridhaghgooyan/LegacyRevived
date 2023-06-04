<?php
namespace App\Model;
class Task {
    public function __construct(){
        global $db;
        global $table;
        $this->db = $db;
        $table = 'ticket';
    }
    public function task_vote($data){
        $task_id = $data['task_id'];
        $customer_id = $data['customer_id'];
        $operator_id = $data['operator_id'];
        $has_badge = $data['has_badge'];
        $has_expert = $data['has_expert'];
        $has_good_action = $data['has_good_action'];
        $has_fast = $data['has_fast'];
        $hast_faq = $data['hast_faq'];
        $has_ontime = $data['has_ontime'];
        $has_eq  = $data['has_eq'];
        $other = $data['other'];
        $this->db->query("insert into task_vote
        (task_id,customer_id,operator_id,has_badge,has_expert,has_good_action ,has_fast ,hast_faq,has_ontime ,has_eq ,other)
        values ($task_id,$customer_id,$operator_id,$has_badge,$has_expert,$has_good_action,$has_fast,$hast_faq,$has_ontime,$has_eq,'$other');
    ");
    }
    public function without_vote(){
        $query = $this->db->query("select * from tasks where has_vote = 0");
        return $query->fetchAll();
    }
    public function dr_task_create($data,$gDate) {
        $creator_id = $data["creator_id"];
        $taskID = rand();
        $invoice_id = $data['invoice_id'];
        $customer_id = $data["customer_id"];
        $operator_id  = $data["adminuser_id"];
        $title = $data["title"];

        $this->db->query("
        insert into tasks
            (creator,task_id,invoice_unique_id,customer_id,operator_id ,title,due_date_time)
            values ('$creator_id','$taskID','$invoice_id','$customer_id','$operator_id','$title','$gDate')
            ");
        // Increase Admin User Due Count
        $this->db->query("update users set jobs = jobs + 1 where id = $creator_id");
        $this->db->query("update invoices set task_id='$taskID' where unique_id='$invoice_id'");
    }
    public function list($creator_id){
        $query = $this->db->query("select * from tasks where creator=$creator_id");
        return $query->fetchAll();
    }
    public function delete($id){
        $this->db->query("delete from tasks where id = $id");
    }
    public function dr_task_list($dr_id){
        $query = $this->db->query("
        select tasks.* , invoices.description , invoices.final_price , invoices.id as invoice_id
from tasks
LEFT JOIN invoices on invoices.task_id = tasks.task_id
where tasks.operator_id = $dr_id and tasks.has_done = 0
        ");
        return $query->fetchAll();
    }
    public function dr_done($data){
        $task_id = $data['task_id'];
        $message = $data['drComment'];
        $this->db->query("update tasks set operator_comment = '$message',has_done = 1 where task_id=$task_id");
    }
    public function add_comment($data): bool
    {
        try {
            $this->db->query("insert into comments(customer_id,creator_id,invoice_unique_id,text)
            values (
                    $data->customer_id,
                    $data->creator_id,
                    '$data->unique_id',
                    '$data->message'
            )
            ");
            return true;
        }
        catch (\PDOException $e){
            return false;
        }
    }
    public function nurse_tasks_list(){
        try {
            $query = $this->db->query("SELECT tasks.* , admins.* , admins.id as admin_id , users.* , users.id as user_id
FROM `tasks`
LEFT JOIN admins on admins.id = tasks.operator_id
LEFT JOIN users on users.id = tasks.customer_id
HAVING admins.roll_id = 7");
            return $query->fetchAll();
        }
        catch (\PDOException $e){
            return false;
        }
    }

    public function my_tasks($id){
        try {
            $query = $this->db->query("SELECT tasks.* , tasks.id as task_id, users.* , users.id as user_id , admins.* , admins.id as admin_id
            FROM `tasks`
            LEFT JOIN users on users.id = tasks.customer_id
            LEFT JOIN admins on admins.id = tasks.operator_id
            WHERE tasks.has_done = 0 and admins.id = $id");
            return $query->fetchAll();
        }
        catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function add_task_comment($data): bool
    {
        try {
            $this->db->query("UPDATE tasks set operator_comment = '$data->comment' , has_done = 1 where id = $data->id");
            return true;
        }
        catch (\PDOException $e){
            return false;
        }
    }


}
