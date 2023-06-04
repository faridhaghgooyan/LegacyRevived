<?php
namespace App\Model;
class Reception{
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function ready_customers(): array
    {
        $query = $this->db->query("
        SELECT payments.* , users.* , users.id as user_id , invoices.* , comments.* , tasks.invoice_unique_id as task_invoice_id
        FROM payments
        LEFT JOIN users on users.id = payments.customer_id
        LEFT JOIN invoices on invoices.unique_id = payments.invoice_unqiueID
        LEFT JOIN tasks on invoices.unique_id = tasks.invoice_unique_id
        LEFT JOIN comments on comments.invoice_unique_id = payments.invoice_unqiueID
        WHERE payments.status != '2' and invoices.status != '3'
        GROUP by payments.invoice_unqiueID order by payments.id desc
        ");
        return $query->fetchAll();
    }
    public function service_req() :array
    {
        $query = $this->db->query("
        SELECT service_req.* , service_req.id as req_id , services.* , users.*
        from service_req
        LEFT JOIN services on service_req.service_id = services.id
        LEFT JOIN users on service_req.customer_id = users.id
        WHERE service_req.status = 0
        order by service_req.id desc
        ");
        return $query->fetchAll();
    }
    public function nurses(): array
    {
        $query = $this->db->query("SELECT * FROM admins where roll_id = 7 order by id desc");
        return $query->fetchAll();
    }
    public function nurse_tasks($creator_id): array
    {
        $query = $this->db->query("
        SELECT tasks.* , tasks.id as task_id , admins.* , admins.id as admin_id , users.* , users.id as user_id
        FROM tasks
        LEFT JOIN admins ON tasks.operator_id = admins.id
        LEFT JOIN users on tasks.customer_id = users.id
        WHERE tasks.creator = $creator_id and tasks.invoice_unique_id is null
        order by tasks.id desc
        ");
        return $query->fetchAll();
    }
    public function dr_tasks($creator_id): array
    {
        $query = $this->db->query("
        SELECT tasks.* , tasks.id as task_id , admins.* , admins.id as admin_id , users.* , users.id as user_id
        FROM tasks
        LEFT JOIN admins ON tasks.operator_id = admins.id
        LEFT JOIN users on tasks.customer_id = users.id
        WHERE tasks.creator = $creator_id and tasks.invoice_unique_id is not null
        order by tasks.id desc
        ");
        return $query->fetchAll();
    }
    public function task_show($id)
    {
        $query = $this->db->query("
        SELECT tasks.* , tasks.id as task_id , admins.* , admins.id as admin_id , users.* , users.id as user_id
        FROM tasks
        LEFT JOIN admins ON tasks.operator_id = admins.id
        LEFT JOIN users on tasks.customer_id = users.id
        WHERE tasks.id = $id
        ");
        return $query->fetch();
    }
    public function invoice_detail($id)
    {
        $query = $this->db->query("
        SELECT invoices.* , users.* , users.id as user_id
        from invoices
        LEFT JOIN users on users.id = invoices.customer_id
        where invoices.unique_id = '$id'
        ");
        return $query->fetch();
    }
    public function task_delete($id)
    {
        $this->db->query("DELETE FROM tasks where id = $id");
    }

    // Add Tasks
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
    public function task_update($data,$date)
    {

        $this->db->query("UPDATE tasks set
        invoice_unique_id = '$data->invoice_unique_id',
        title = '$data->title',
        customer_id = '$data->customer_id',
        operator_id = '$data->operator_id',
        creator_comment = '$data->creator_comment',
        due_date_time = '$date'
        where tasks.id = $data->task_id

        ");
    }
    public function deleteTask($id){
        $query = $this->db->query("select creator from tasks where id=$id");
        $user = $query->fetchAll();
        $user_id = $user[0]["creator"];
        $this->db->query("delete from tasks where id=$id");
        $this->db->query("update users set jobs = jobs - 1 where id = $user_id");
    }





}
