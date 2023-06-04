<?php
namespace App\Model;
class Finance {
    public function __construct(){
        global $db;
        global $table;
        $this->db = $db;
        $table = 'ticket';
    }

    public function invoicesList(){
        $query = $this->db->query("
         SELECT invoices.* ,invoices.status as invoice_status , invoices.id as invoice_id , admins.* , admins.id as admin_id , users.* , users.id as user_id
            FROM invoices
            LEFT JOIN admins on admins.id = invoices.creator_id
            LEFT JOIN users on users.id = invoices.customer_id
            order by invoices.id desc
         ");
        return $query->fetchAll();
    }
    public function oldInvoices(){
        $query = $this->db->query("select * from invoices where status = 1 order by id asc  ");
        return $query->fetchAll();
    }
    public function unpaidInvoices(){
        $query = $this->db->query("select * from invoices where status = 1 order by id asc  ");
        return $query->fetchAll();
    }
    public function payments(){
        $query = $this->db->query("select * from payments order by id desc");
        return $query->fetchAll();
    }
    public function newPayments(){
        $query = $this->db->query("select * from payments where accepted_by is null order by id desc");
        return $query->fetchAll();
    }
    public function changeStatus($data,$id,$user_id){
        // Get Payments by ID
        $query =  $this->db->query("select * from payments where id = $id");
        $res =  $query->fetch();
        $task_id =  $res['task_id'];
        // Get TotalPrice
        $query =  $this->db->query("select price from invoices where task_id= $task_id");
        $totalPrice = $query->fetch()[0];
        // Check User Payments
        $totalPaid = 0;




        if ($data == 'accepted') {

            $this->db->query("update payments set accepted_by = $user_id where id =$id");

            $query =  $this->db->query("select price from payments where task_id = $task_id and accepted_by is not null");
            $payments =  $query->fetchAll();
            foreach ($payments as $payment){
                $totalPaid += $payment["price"];
            }

            // Approve For DR
            if ($totalPaid >= $totalPrice) {
                $this->db->query("update tasks set has_paid = 1 where task_id =$task_id");
            }

        } else {

            $this->db->query("update payments set accepted_by = NULL where id =$id");

            $query =  $this->db->query("select price from payments where task_id = $task_id and accepted_by is not null");
            $payments =  $query->fetchAll();
            foreach ($payments as $payment){
                $totalPaid += $payment["price"];
            }
            if ($totalPaid < $totalPrice) {
                $this->db->query("update tasks set has_paid = 0 where task_id =$task_id");
            }

        }

    }
    public function accOrRej($payment_id,$payment_action,$admin_user){
        if ($payment_action == 'accept'){
            $this->db->query("update payments set accepted_by=$admin_user , status = 1 where id=$payment_id");
        } else {
            $this->db->query("update payments set accepted_by = null , status = 0 where id=$payment_id");
        }
    }
    public function accepted_payments(){
        $query = $this->db->query("select * from payments where accepted_by is not null");
        return $query->fetchAll();
    }
}