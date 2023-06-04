<?php
use App\Model\uploader;
use App\Model\payment;
use App\Model\invoice;
use App\Model\Zarinpal;

require_once '../app/models/users.php';
require_once '../app/models/uploader.php';
require_once '../app/models/invoices.php';
require_once '../app/models/payments.php';
require_once '../app/models/Zarinpal.php';

$users_obj = new users();
$uploader = new uploader();
$invoices_obj = new invoice();
$payments_obj = new payment();
$zarinpal_obj = new Zarinpal();

switch ($action){
    case 'idPay' :

        $result = $invoices_obj->idPay((object)$_POST);
        $result = json_decode($result);

        $unique_id = $_POST['unique_id'];
        if ($result->id){
            header("location:$result->link");
        } else {
            header("location:/user/?c=users&a=pay&id=$unique_id");
        }

        die();

        break;
    case 'withFish':
        $link = '';
        if ($_FILES['cardtocard']){
            $link = $uploader->fileUpload($_FILES['cardtocard'],'fish');
        }
        $_POST['link'] = $link;

        $payments_obj->pay_with_fish((object)$_POST);
        header('location:?c=index&a=index');
        die();
        break;
    case 'callback':
        $payment = $payments_obj->find_by_tracking_code($_GET['Authority']);
        if ($_GET['Status'] == 'OK'){
            $transaction_id = $zarinpal_obj->verify($payment['price']);
            $payments_obj->success_payment($_GET['Authority'],$transaction_id);
        } else {
        }
        break;

}