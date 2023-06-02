<?php
use app\models\chat;
use app\models\uploader;
use app\models\users;
use app\models\services;
require_once '../app/models/uploader.php';
require_once '../app/models/chat.php';
require_once '../app/models/users.php';
require_once '../app/models/services.php';
$uploader = new uploader();
$chat = new chat();
$user = new users();
$services_obj = new services();
switch ($action){
    case 'store' :
        $filetype = NULL;
        $path = NULL;
        if ($_FILES["chatfile"]["size"] > 0){
            $file = $_FILES["chatfile"];
            $ext = explode('/',$file["type"]);
            switch ($ext[0]){
                case 'image' :

                    $filename = rand().'.'.$ext[1];
                    $path = '../storage/chat/img/'.$filename;
                    $filetype = 'image/jpg';
                    break;
                case 'application' :

                    $filename = rand().'.'.$ext[1];
                    $path = '../storage/chat/pdf/'.$filename;
                    $filetype = 'application/pdf';
                    break;
                case 'wav' :
                    $filename = rand().'.wav';
                    $path = '../storage/chat/voice/'.$filename;
                    $filetype = 'audio/wav';
                    break;
            }
            // Upload Chat File
            $uploader->chat_uploader($file,$path);


        }
        $chat->adminStore($_POST,$loggedUser_id,$filetype,$path);

        $response = array(
            "message" => $_POST['text'],
            "filetype" => $filetype,
            "path" => $path);

        echo json_encode($response);

        break;

    case 'chatsList' :
        $list = $user->chat_list($loggedUser_id);
        $i = 0;
        foreach ($list as $item){
            $user_name = $user->find($item['user_id']);
            $list[$i]['user_name'] = $user_name['firstName'] . ' ' . $user_name['lastName'];
            $i++;
        }
//        echo '<pre>', var_dump($list), '</pre>';die();

        echo json_encode($list);

        break;
    case 'services_list':
        echo json_encode($services_obj->admin_service_req_list());
        break;
    case 'findUser':
        echo json_encode($user->find($_GET['id']));
        break;
}