<?php
use app\models\doctors;
use app\models\uploader;
use app\models\payments;
use app\models\dateConverter;
use app\models\services;
use app\models\invoices;
use app\models\Sms;
use app\models\Zarinpal;
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/uploader.php';
require_once '../app/models/payments.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/services.php';
require_once '../app/models/invoices.php';
require_once '../app/models/sms.php';
require_once '../app/models/Zarinpal.php';
require_once '../../includes.php';

$users_obj = new users();
$dr_obj = new doctors();
$uploader = new uploader();
$payments_obj = new payments();
$services_obj = new services();
$invoices_obj = new invoices();
$Zarinpal_obj = new Zarinpal();
$sms_obj = new Sms();
switch ($action){
    case 'login':
        $mobile = $_POST['mobile'];
        $pass = sha1($_POST['password']);
        $user = $users_obj->login($mobile);
        if ($user['mobile'] == $mobile && $user['password'] == $pass){
            setcookie("TF-Mobile", $mobile, time()+(86400 * 30));
            header('location:/user?c=index&a=index');
        } else {
            header('location:/');
        }
        break;
    case 'doneInvoices':
        $invoices = $invoices_obj->paid($loggedUser_id);

        break;
    case 'loginByCode':
        $code = $_GET['code'];
        $user = $users_obj->loginByCode($code);
        if ($user){
            setcookie("Customer-Code", $code, time()+(86400 * 30));
            header('location:/user?c=index&a=index');
        } else {
            header('location:/');
        }
        break;
    case 'signup':
        $mobile = $_POST['mobile'];
        $user = $users_obj->findByMobile($mobile);
        if ($user['mobile'] == $mobile){
            echo 'Try again';
        } else {
            $signup = $users_obj->signup($_POST);
            if ($signup){
                setcookie("TF-Mobile", $mobile, time()+3600);
                header('location:/user?c=index&a=index');
            }
        }
        break;
    case 'idPay':

//        $order_id = $_POST['invoiceID'];
//
//        $payments_obj->idpayCreate($_POST);

//        $createIdPay_obj = json_decode($createIdPay);
//        $callback_id = $createIdPay_obj->id;
//        $callback_link = $createIdPay_obj->link;
//        $verify = $payments_obj->idpayVerify($callback_id,$order_id);

        break;
    case 'pay':
        $invoice = $invoices_obj->read($_GET['id']);
        $customer = $users_obj->find($invoice['customer_id']);
        $zarinpal = $Zarinpal_obj->request($invoice,$customer);
        dd($zarinpal);
//        $invoice_id = $_GET['id'];
//        $dateConvertor_obj = new dateConverter();
//        $invoice = $users_obj->get_invoice($invoice_id);
//        $total_payments = 0;
//        $all_payments = $payments_obj->invoice_payments($invoice['unique_id']);
//        foreach ($all_payments as $payment){
//            if ($payment['accepted_by'] != 0){
//                $total_payments += $payment["price"];
//            }
//        }
//        $invoice_date = $dateConvertor_obj->dateConvert($invoice['created_at'])[0]['date'];
//        $payments = $users_obj->invoice_payments($invoice['unique_id']);
//        $users_obj->update_task($invoice_id);
        break;
    case 'payWithCart':
        var_dump($_FILES);die();
        break;
    case 'logout':
        $user_id = $loggedUser_id;
        setcookie('TF-Mobile','',time()-3600,'/');
        header('location:/');
        break;
    case 'add':
        echo 'Connected to Users Controller';
        break;
    case 'list':
        $users = $users_obj->users_list();
        break;
    case 'edit':
        $id = $_GET['id'];
        $user = $users_obj->edit($id);
        break;
    case 'update':
        $path = $uploader->upload($_FILES['profilepic']);
        $data = $_POST['data'];
        $user = $users_obj->update($data,$path);
        break;
    case 'show':
        break;
    case 'chat_history':
        $chat_history = $users_obj->chat_list();
        $doctors = new doctors();
        $user = new users();
        break;
    case 'unpaidInvoices':
        $dateConvertor_obj = new dateConverter();
        $invoices = $invoices_obj->user_invoices($loggedUser_id);
        break;
    case 'tasksList':

        $tasks = $user->tasksList($loggedUser_id);

        break;
    case 'doneTasks':
        $doneTasks = $user->doneTasks($loggedUser_id);
        break;
    case 'readProfile':
        $myself = $user->find($loggedUser_id);
        break;
    case 'changeProfile':
            $pic = '';
            if ($_FILES["pic"]["size"] != 0){
                $folder = 'profile';
                $pic = $uploader->fileUpload($_FILES["pic"],$folder);
            }
            $user->update($_POST,$pic);
        break;
    case 'changePass':

            $password = sha1($_POST['password']);
            $user->changePass($password,$loggedUser_id);
        break;
    case 'service_req' :

        $service = (object)$services_obj->find($_POST["service_id"]);
        $service_name = str_replace(" ","_",$service->title);
        $mobile = $user_info['mobile'];
        $user = $users_obj->findByMobile($mobile);
        $_POST['customer_id'] = $user['id'];
        $username = str_replace(" ","_",$user_info['lastName']);

        $sms_obj->sendNow("$mobile","serviceReq","$username","$service_name",'',);
        $services_obj->customer_req($_POST);
        header('location:/');
        break;
    case 'changePassword':
        try {

            if ($_POST['password'] == $_POST['confirm_password']){
                $_POST['password'] = sha1($_POST['password']);
                $_POST['id'] = $loggedUser_id;
                $_POST['token'] = NULL;
                $users_obj->modify($_POST);
            }
            back();
        } catch (Exception $e){

        }



        break;


}