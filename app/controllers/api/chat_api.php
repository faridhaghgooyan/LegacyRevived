<?php
require_once dirname(__DIR__,2)."/models/uploader.php";
require_once dirname(__DIR__,2)."/models/chat.php";
require_once dirname(__DIR__,2)."/models/users.php";
use app\models\chat;
use app\models\uploader;
$chat_obj = new chat();
$user_obj = new users();
$uploader_obj = new uploader();

if ($_SERVER['REQUEST_METHOD'] == "GET"){

}
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    switch ($_POST['action']){
        case "send":
            $_POST['path'] = '';
            if ($_POST['message_type'] == 'link'){
                $_POST['path'] = $_POST['message'];
                $_POST['message'] = '';
            }
            $result = $chat_obj->store((object)$_POST);
            echo json_encode($_POST);
            break;
        case "send_image":
            $_POST['message'] = '';
            $status = $uploader_obj->uploader($_FILES['file']);
            if ($status['upload_status'] == 1){
                $_POST['path'] = $status['path'];
                $result = $chat_obj->store((object)$_POST);
                echo json_encode($_POST);
            } else {
                echo json_encode($status);
            }


            break;
        case "send_voice":
            $_POST['user_id'] = 1036;
            $_POST['user_type'] = 'user';
            $_POST['message_type'] = 'voice';
            $_POST['message'] = '';
            $status = $uploader_obj->uploader($_FILES['audio_data']);
            if ($status['upload_status']){
                $_POST['path'] = $status['path'];
                $result = $chat_obj->store((object)$_POST);
                echo json_encode($_POST);
            }else {
                echo json_encode($status);
            }


            break;
        case "get_new_chat":
            if (isset($_POST['roll_title']) && $_POST['roll_title'] == 'site_admin'){
                $new_chats = $chat_obj->get_new_chat($_POST['code'],$_POST['user_type']);
            } else {
                $new_chats = $chat_obj->get_new_chat($_POST['code'],$_POST['user_type']);
            }
            $ids = array_column($new_chats,'id');
            echo json_encode($new_chats);
            $chat_obj->update_new_chats($ids);
            break;
        case "get_old_chat":
            $last_chats = $chat_obj->get_old_chat($_POST['code'],$_POST['offset']);
            if (!$last_chats){
                $response = array(
                    "error"=>"سوابق قدیمی تری وجود ندارد!"
                );
                echo json_encode($response);

            } else {
                echo json_encode($last_chats);
            }
            break;
        case "my_customers":
            if (isset($_POST['roll_title']) && $_POST['roll_title'] == 'site_admin'){
                $customers1 = $user_obj->site_admin_customers1();
                $customers2 = $user_obj->site_admin_customers2();
                $customers = array_merge($customers1,$customers2);
            } else {
                $customers = $user_obj->my_customers($_POST['admin_id'],$_POST['offset']);
            }
            if ($customers){
                echo json_encode($customers);
            } else {
                $response = array(
                    "error"=>"زیباجویان بیشتری وجود ندارند!"
                );
                echo json_encode($response);
            }
            break;

    }
}
