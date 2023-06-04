<?php
use App\Model\chat;
require_once '../app/models/chat.php';
require_once '../app/models/users.php';
$chat_obj = new chat();
$uses_obj = new users();
switch ($action){
    case 'drtoChat' :
        $id = $_POST['chat_id'];
        $dr_id = $_POST['doctors_list'];
        $chat_obj->drtoChat($id,$dr_id);
        break;

    case 'addToConsultant':
        $consultant_id = $_POST["consultant_id"];
        $chatFile = $_POST["chatFile"];
        $customer_id = $uses_obj->find_chat_file($chatFile)["user_id"];
        $chat_obj->add_to_consultant($chatFile,$consultant_id,$customer_id);

        var_dump($chat_obj);
        break;
    case 'addToSupporter':
        $supporter = $_POST["supporter_id"];
        $chatFile = $_POST["chatFile"];
        $message = $_POST["message"];
        $chat_obj->addToSupporter($chatFile,$supporter,$message);
        break;
    case 'user_efile':

        break;
}