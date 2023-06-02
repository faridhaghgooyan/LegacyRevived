<?php
use app\models\dateConverter;
use app\models\kavehSms;
use app\models\Sms;
require_once '../app/models/users.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/kavehSms.php';
require_once '../app/models/sms.php';

$admin = array();
$user_obj = new users();
$permission_obj = new permissions();
$sms_obj = new kavehSms();
$dateCovert = new dateConverter();
$sendSms_obj = new Sms();

switch ($action){
    case 'create':
        $sms_obj->create($_POST["text"],$_POST["code"]);
        header('location:?c=sms&a=list');
        break;
    case 'list':
        $sms_list = $sms_obj->list();
        break;
    case 'read':
        $sms = $sms_obj->read($_GET['id']);
        break;
    case 'update':
        $sms_obj->update($_POST["text"],$_POST["code"],$_GET['id']);
        break;
    case 'delete':
        $sms_obj->delete($_GET["id"]);
        break;
    case 'sendSMS':

        switch ($_GET['code']){
            case 'loginLink':
                $user = $user_obj->findByMobile($_GET['receptor']);
                $username = str_replace(' ','.',($user['firstName'].'.'.$user['lastName']));
                $result = $sendSms_obj->sendLink($user['mobile'],$username,$_GET['link'],null,$_GET['code']);
                break;
        }
        break;
    case 'sendSMSOld':
        $sms = $sms_obj->find_sms($_POST['sms_code'])[0]['text'];
        $customer_mobile = $user_obj->find($_POST['user_id'])['mobile'];
        $customer_name = $user_obj->find($_POST['user_id'])['firstName'].' '.$user_obj->find($_POST['user_id'])['lastName'];
        $consultant = $user_obj->get_user_name($loggedUser_id);
        $consultant_phone = $user_obj->find($loggedUser_id)['mobile'];
        $date = '';
        if ($_POST['sms_date']){
            $date = $_POST['sms_date'];
        }
        $time = '';
        if ($_POST['sms_time']){
            $time = $_POST['sms_time'];
        }
        $price = '';
        if ($_POST['sms_price']){
            $price = $_POST['sms_price'];
        }
        $ready_sms = str_replace(array(
            '[customer]',
            '[consultant]',
            '[consultant_phone]',
            '[date]',
            '[clock]',
            '[price]'
        ), array(
            $customer_name,
            $consultant,
            $consultant_phone,
            $date,
            $time,
            number_format($price)
        ),$sms);
        echo $ready_sms;
        switch ($_POST['sms_code']){
            case '8':
                $sms = $sms_obj->find_sms($_POST['sms_code']);
                foreach ($sms as $sms_index){
                    $customer_mobile = $user_obj->find($_POST['user_id'])['mobile'];
                    $customer_name = $user_obj->find($_POST['user_id'])['firstName'].' '.$user_obj->find($_POST['user_id'])['lastName'];
                    $consultant = $user_obj->get_user_name($loggedUser_id);
                    $consultant_phone = $user_obj->find($loggedUser_id)['mobile'];
                    $date = '';
                    if ($_POST['sms_date']){
                        $date = $_POST['sms_date'];
                    }
                    $time = '';
                    if ($_POST['sms_time']){
                        $time = $_POST['sms_time'];
                    }
                    $price = '';
                    if ($_POST['sms_price']){
                        $price = $_POST['sms_price'];
                    }
                    $ready_sms = str_replace(array(
                        '[customer]',
                        '[consultant]',
                        '[consultant_phone]',
                        '[date]',
                        '[clock]',
                        '[price]'
                    ), array(
                        $customer_name,
                        $consultant,
                        $consultant_phone,
                        $date,
                        $time,
                        number_format($price)
                    ),$sms_index["text"]);
                    $sms_obj->sendSMS($customer_mobile,$ready_sms);
                    sleep(3);
                    echo $ready_sms;
                }
                header('location:?c=index&a=index');
                break;

            default :
                $sms_obj->sendSMS($customer_mobile,$ready_sms);
                header('location:?c=index&a=index');
                break;
        }
        header('location:?c=index&a=index');

        break;

}