<?php
namespace App\Model;
use App\Model\user;
class Payment{
    private $table = 'payments';
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
    public function idpayCreate($data){
        $order_id =  $data['invoiceID'];
        $amount = $data['invoicePrice'];
        $name = $data['userName'];
        $phone = $data['userMobile'];
        $email = $data['userEmail'];
        $desc = $data['invoiceDesc'];

        //API URL
        $url = 'https://api.idpay.ir/v1.1/payment';
        $ch = curl_init($url);
        $data = array(
            'order_id' => $order_id,
            'amount' => $amount,
            'name' => $name,
            'phone' => $phone,
            'mail' => $email,
            'desc' => $desc,
            'callback' => 'http://localhost/'
        );
        $payload = json_encode($data);
        $headers = array(
            "Content-Type:application/json",
            "X-API-KEY:d3dec78a-7c82-4689-b5c7-1121dcc124e0",
            "X-SANDBOX:1"
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
    public function idpayVerify($id,$order_id){

        //API URL
        $url = 'https://api.idpay.ir/v1.1/payment/verify';
        $ch = curl_init($url);
        $data = array(
            'id' => $id,
            'order_id' => $order_id
        );
        $payload = json_encode($data);
        $headers = array(
            "Content-Type:application/json",
            "X-API-KEY:d3dec78a-7c82-4689-b5c7-1121dcc124e0",
            "X-SANDBOX:1"
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function payments_list():array
    {
        $query = $this->db->query("
        SELECT payments.* , payments.created_at as payment_created_at, payments.id as payment_id ,payments.link as payment_fish, invoices.* , invoices.id as invoice_id , users.* , users.id as user_id , admins.* , admins.id as admin_id
        FROM payments
        LEFT JOIN invoices on invoices.unique_id = payments.invoice_unqiueID
        LEFT JOIN users on users.id = payments.customer_id
        LEFT JOIN admins on admins.id = invoices.creator_id
        WHERE payments.status != '2'
        order by payments.id desc
        ");
        return $query->fetchAll();
    }
    public function cancel_payments():array
    {
        $query = $this->db->query("
        SELECT payments.* , payments.created_at as payment_created_at, payments.id as payment_id ,payments.link as payment_fish, invoices.* , invoices.id as invoice_id , users.* , users.id as user_id , admins.* , admins.id as admin_id
        FROM payments
        LEFT JOIN invoices on invoices.unique_id = payments.invoice_unqiueID
        LEFT JOIN users on users.id = payments.customer_id
        LEFT JOIN admins on admins.id = invoices.creator_id
        WHERE payments.status = '2'
        order by payments.id desc
        ");
        return $query->fetchAll();
    }
    public function invoice_payments($invoice_id){
        $query = $this->db->query("select * from payments where invoice_unqiueID=$invoice_id ");
        return $query->fetchAll();
    }
    public function get_total_payment($invoice_id){
        $query = $this->db->query("SELECT sum(price) as total_payment FROM payments
WHERE invoice_unqiueID = '$invoice_id'");
        return $query->fetch();
    }


    public function idPay($data)
    {
        $params = array(
            'order_id' => "$data->unique_id",
            'amount' => $data->amount_pay,
            'name' => "$data->userName",
            'phone' => "$data->userMobile",
            'mail' => "$data->userEmail",
            'desc' => "$data->invoiceDesc",
            'callback' => "https://clog.tootfarangee.com/callback.php"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: 08f3f803-a659-4568-a528-340b84cf4dc6'
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function idPay_success($data)
    {

    }
    public function pay_with_fish($data)
    {
        $this->db->query("INSERT INTO payments(type,invoice_unqiueID,customer_id,price,link)
        values
        (
                '$data->type',
                '$data->invoice_unqiueID',
                '$data->customer_id',
                '$data->price',
                '$data->link'
        )

        ");
    }
    public function has_payment($unique_code){
        try {
            $query = $this->db->query("
            SELECT * FROM payments where invoice_unqiueID = '$unique_code'
            ");
            return $query->fetch();
        } catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function total_payments($unique_code){
        try {
            $query = $this->db->query("
            SELECT sum(price) as total_payment FROM payments where invoice_unqiueID = '$unique_code'
            ");
            return $query->fetch()[0];
        } catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function add_payment_code($invoice_data,$customer_data ,$tracking_code ){

        try {
            $this->db->query("INSERT INTO payments(invoice_unqiueID,customer_id,price,tracking_code)
                VALUES ($invoice_data->unique_id,$customer_data->id,$invoice_data->final_price,'$tracking_code') ");
            return $this->db->lastInsertId();
        }catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function success_payment($tracking_code,$transaction_id){
        try {
            $this->db->query("UPDATE payments SET
                status = 1,
                RefID = '$transaction_id'
                where tracking_code = '$tracking_code'");
            return true;
        }catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function find_by_tracking_code($tracking_code){
        try {
            $query = $this->db->query("SELECT * FROM payments where tracking_code = '$tracking_code'");
            return $query->fetch();
        }catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function find_by_unique_id($invoice_unqiueID){
        try {
            $query = $this->db->query("SELECT * FROM payments where invoice_unqiueID = '$invoice_unqiueID'");
            return $query->fetch();
        }catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function change_status($invoice_unqiueID,$status,$desc){
        try {

            $query = $this->db->query("update payments set status = $status , description = '$desc' where invoice_unqiueID = '$invoice_unqiueID' ");
            return true;
        }catch (\PDOException $e){
            return $e->getMessage();
        }
    }

}
