<?php
use app\models\uploader;
use app\models\invoices;

require_once '../app/models/users.php';
require_once '../app/models/uploader.php';
require_once '../app/models/invoices.php';

$users_obj = new users();
$uploader = new uploader();
$invoices_obj = new invoices();

switch ($action){
    case 'idPay' :

        $result = $invoices_obj->idPay((object)$_POST);
        $result = json_decode($result);
        var_dump($result);die();
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

        $invoices_obj->pay_with_fish((object)$_POST);
        header('location:?c=index&a=index');
        die();
        break;

}