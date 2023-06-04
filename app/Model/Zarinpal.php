<?php
namespace App\Model;
use App\Model\Payment;
class Zarinpal {
    private $merchant_id = 'bcd15e1c-b816-11ea-b520-000c295eb8fc';
    private $callback = 'https://clog.tootfarangee.com/user/?c=payments&a=callback';
    public function __construct() {
        global $db;
        $this->db=$db;
    }
    public function request($invoice_data,$customer_data){
        $data = array("merchant_id" => $this->merchant_id,
            "amount" => $invoice_data['final_price'],
            "callback_url" => $this->callback,
            "description" => $invoice_data['subject'],
            "metadata" => [
                "email" => $customer_data['email'],
                "mobile"=>$customer_data['mobile']
            ],
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        curl_close($ch);



        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {
                    $payment_obj = new payment();
                    $payment = $payment_obj->add_payment_code((object)$invoice_data,(object)$customer_data,$result['data']["authority"]);
                    header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
                }
            } else {
                echo'Error Code: ' . $result['errors']['code'];
                echo'message: ' .  $result['errors']['message'];

            }
        }
    }
    public function verify($amount){
        $Authority = $_GET['Authority'];
        $data = array(
            "merchant_id" => $this->merchant_id,
            "authority" => $Authority,
            "amount" => $amount
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $err = curl_error($ch);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['data']['code'] == 100) {
                echo 'Transation success. RefID:' . $result['data']['ref_id'];
            } else {
                echo'code: ' . $result['errors']['code'];
                echo'message: ' .  $result['errors']['message'];
            }
        }
    }


}