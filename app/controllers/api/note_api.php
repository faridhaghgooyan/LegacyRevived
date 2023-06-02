<?php
require_once dirname(__DIR__,2)."/models/uploader.php";
require_once dirname(__DIR__,2)."/models/notes.php";
require_once dirname(__DIR__,2)."/models/users.php";
require_once dirname(__DIR__,2)."/models/dateConverter.php";
use app\models\notes;
use app\models\uploader;
use app\models\dateConverter;
$note_obj = new notes();
$user_obj = new users();
$uploader_obj = new uploader();
$dateConverter = new dateConverter();
if ($_SERVER['REQUEST_METHOD'] == "GET"){

}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    switch ($_POST['action']){
        case "list":
            $notes = $note_obj->list($_POST['chat_code'],$_POST['offset']);
            if ($notes){
                echo json_encode($notes);
            } else {
                $response = array(
                    "error"=>"یادداشتی برای این زیباجو وجود ندارد!"
                );
                echo json_encode($response);
            }
            break;
        case "create":
            $now = date("Y-m-d H:i:s");
            $date = $dateConverter->date_convert($now,"jalali");
            $_POST['fa_time'] = $date[0]['time'];
            $_POST['fa_date'] = $date[0]['date'];
            $result = $note_obj->create(
                $_POST['chat_code'],
                $_POST['text'],
                $_POST['fa_time'],
                $_POST['fa_date']
            );
            if ($result){
                echo  json_encode($_POST);
            } else {
                $response = array(
                    "error"=>"هنگام ثبت یادداشت مشکلی پیش آمده ، مجددا تلاش کنید!"
                );
                echo json_encode($response);
            }
            break;


    }
}
