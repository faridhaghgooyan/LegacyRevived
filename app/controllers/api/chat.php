<?php
use App\Model\chat;
use App\Model\uploader;
use App\Model\dateConverter;
require_once '../app/models/uploader.php';
require_once '../app/models/chat.php';
require_once '../app/models/users.php';
require_once '../app/models/dateConverter.php';
$uploader = new uploader();
$chat = new chat();
$user = new users();
$date_converter = new dateConverter();
switch ($action){
    case 'store':
        $_POST['message'] = (isset($_POST['message'])?$_POST['message']:null);
        $_POST['owner_id'] = (isset($_POST['owner_id'])?$_POST['owner_id']:null);
        $_POST['user_id'] = (isset($loggedUser_id)?$loggedUser_id:null);
        $_POST['fa_date'] = $date_converter->date_convert(date('Y-m-d H:i:s'),'jalali')[0]['date'];
        $_POST['fa_time'] = $date_converter->date_convert(date('Y-m-d H:i:s'),'jalali')[0]['time'];
        $_POST['path'] = null;
        $_POST['code'] = (!empty($_POST['chat_code']))?$_POST['chat_code']:$_POST['code'];
        switch ($_POST['message_type']){
            case 'text':
                $query = $chat->create((object)$_POST);
                if ($query){
                    echo json_encode($_POST);
                } else {
                    echo json_encode('403');
                }
                break;
            case 'image':
                if (isset($_FILES['file']) && $_FILES['file']['size'] > 0){
                    $path = $uploader->fileUpload($_FILES['file'],'chat');
                    $_POST['path'] = $path;
                    $query = $chat->create((object)$_POST);
                    if ($query){
                        echo json_encode($_POST);
                    } else {
                        echo json_encode('403');
                    }
                }
                break;
        }
        break;
    case 'update':

        switch ($admin_info->roll_title){
            case 'site_admin':
                $news = $chat->admin_new_chats();
                echo json_encode($news);
                break;

            case 'consultant':
                $news = $chat->consultant_new_chats($admin_info->id);
                echo json_encode($news);
                break;
        }
        break;
    case 'user_update':
        $news = $chat->user_new_chats($_GET['code']);
        echo json_encode($news);
        break;
    case 'user_seen':
    case 'has_seen':
        $chat->has_seen($_GET['id']);
        echo json_encode($_GET['id']);
        break;
    case 'to_gallery':
        $chat->to_gallery($_GET['id'],$_GET['status']);
        echo json_encode($_GET['id']);
        break;





























    case 'store2' :
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
                case 'audio' :
                    $filename = rand().'.wav';
                    $path = '../storage/chat/voice/'.$filename;
                    $filetype = 'audio/wav';
                    break;
            }
            // Upload Chat File
            $uploader->chat_uploader($file,$path);


        }
        $chat->store($_POST,$loggedUser_id,$filetype,$path);

        $response = array(
            "message" => $_POST['text'],
            "filetype" => $filetype,
            "path" => $path);

        echo json_encode($response);

        break;

    case 'createChat':
        echo '<pre>', var_dump($_POST),'</pre>';
        $chat->store($_POST,$loggedUser_id);
        break;
    case 'get_chat-user':

        break;

}