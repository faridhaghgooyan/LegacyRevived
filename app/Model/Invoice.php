<?php
namespace App\Model;
if (file_exists('../config.php')){
    require_once '../config.php';

} else {
    require_once '../../config.php';

}
class Invoice{
    protected $tbl = 'invoices';
    const CANCEL_INVOICE = 3;
    const CLEAR_INVOICE = 4;
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function create($data): array
    {

        try {
            $this->db->query("
            INSERT INTO `$this->tbl`(`subject`, `creator_id`, `customer_id`, `unique_id`, `final_price`, `min_price` ,`description` , `from_date`, `to_date`, `deadline`)
            VALUES (
                    '$data->subject',
                    '$data->creator_id',
                    '$data->customer_id',
                    '$data->unique_id',
                    '$data->final_price',
                    '$data->min_price',
                    '$data->description',
                    '$data->from_date',
                    '$data->to_date',
                    '$data->deadline'
                    )
            ");
            return array(
                'customer_id' => $data->customer_id,
                'creator_id' => $data->creator_id,
                'unique_id' => $data->unique_id,
                'comment' => $data->text
            );
        }
        catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function read($id){
        $query = $this->db->query("
        select invoices.* , users.firstName , users.lastName , users.mobile ,users.fullAddress , users.id as user_id
        from $this->tbl
        left JOIN users on users.id = invoices.customer_id
        where invoices.unique_id = $id order by invoices.id desc
        ");
        return $query->fetch();

    }
    public function update($text,$id){

        $this->db->query("update $this->tbl set text = '$text' where id = $id");
    }
    public function delete($id){
        $this->db->query("delete from invoices where unique_id=$id");
    }
    public function list($id){
        $query = $this->db->query("
        select invoices.* , users.firstName , users.lastName , users.id as user_id , comments.*
        from $this->tbl
        left JOIN users on users.id = invoices.customer_id
        left JOIN comments on comments.customer_id = users.id
        where invoices.creator_id = $id group by invoices.unique_id order by invoices.id desc
        ");
        return $query->fetchAll();
    }
    public function cancel_invoices(){
        $query = $this->db->query("
        select invoices.* , users.firstName , users.lastName , users.pic, users.id as user_id , comments.*
        FROM $this->tbl
        left JOIN users on users.id = invoices.customer_id
        left JOIN comments on comments.customer_id = users.id
        where invoices.status = '3'
        order by invoices.id desc
        ");
        return $query->fetchAll();
    }
    public function complete_list($id): array
    {
        $query = $this->db->query("
        select invoices.* , users.firstName , users.lastName , users.id as user_id , comments.*
        from $this->tbl
        left JOIN users on users.id = invoices.customer_id
        left JOIN comments on comments.customer_id = users.id
        group by invoices.unique_id order by invoices.id desc
        ");
        return $query->fetchAll();
    }
    public function make_deadline($date = null,$days = 31)
    {
        if (!$date){
            $date = date('Y-m-d H:i:s');
        }
        return date('Y-m-d H:i:s',strtotime($date) + (86400 * $days));
    }
    public function user_invoices($user_id): array
    {
        $query = $this->db->query("SELECT * FROM invoices where customer_id = $user_id order by id desc");
        return $query->fetchAll();
    }
    public function paid($user_id): array
    {
        $query = $this->db->query("SELECT * FROM invoices where customer_id = $user_id and status = 1 order by id desc");
        return $query->fetchAll();
    }
    public function total_payments($invoice_id): array
    {
        $query = $this->db->query("SELECT * FROM payments where invoice_unqiueID = $invoice_id and accepted_by != 0 order by id desc");
        return $query->fetchAll();
    }
    public function change_status($unique_code,$status){
        try {

            $this->db->query("update $this->tbl set status = $status where unique_id = $unique_code");
            return true;
        } catch (\PDOException $e){
            return $e->getMessage();
        }
    }




}
