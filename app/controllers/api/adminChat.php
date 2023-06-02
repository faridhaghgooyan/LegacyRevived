<?php
use app\models\chat;
use app\models\uploader;
use app\models\services;
use app\models\notes;
require_once '../app/models/uploader.php';
require_once '../app/models/chat.php';
require_once '../app/models/users.php';
require_once '../app/models/services.php';
require_once '../app/models/notes.php';
$uploader = new uploader();
$chat = new chat();
$user = new users();
$services_obj = new services();
$notes_obj = new notes();
switch ($action){
    case 'has_show':
        $chat->rest_has_show($loggedUser_id);
        break;
    case 'loop':
        $id = $_GET['id'];
        $new_chat = $chat->get_last_chats($loggedUser_id,$id);
        echo json_encode($new_chat);
        break;
    case 'loadMessages':
        switch ($admin_info->roll_title){
            case 'site_admin':
                $chats = $chat->get_admin_chats($_GET['code']);
                $chat->chat_seen($_GET['code']);
                echo json_encode($chats);
                break;

            case 'consultant':
                $chats = $chat->get_chats($_GET['code']);
                $chat->chat_seen($_GET['code']);
                echo json_encode($chats);
                break;
        }



        break;
    case 'storeMessage':
        switch ($_POST['message_type']){
            case 'text':
                $_POST['path'] = $_POST['user_id'] = null;
                $_POST['owner_id'] = $loggedUser_id;
                $_POST['path'] = null;
                $query = $chat->storeMessage((object)$_POST);
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
                    $_POST['message'] = $_POST['user_id'] =  null;
                    $_POST['owner_id'] = $loggedUser_id;
                    $query = $chat->storeMessage((object)$_POST);
                    if ($query){
                        echo json_encode($_POST);
                    } else {
                        echo json_encode('403');
                    }
                }
                break;
        }
        break;
    case 'update_chat':

        $news = $chat->update_admin_chat($_GET['code'],$_GET['rowID']);
        echo json_encode($news);
        break;
    case 'consultant_new_chats':
        $new_chats = $chat->consultant_new_chat($loggedUser_id);
        echo json_encode($new_chats);
        break;
    case 'new_chats':
        $new_chats = $chat->new_chat();
        if ($admin_info->roll_title == 'site_admin'){
            $new_chats = $chat->admin_new_chat();
        }
        echo json_encode($new_chats);
        break;
    case 'checkChat':

        echo json_encode($chat->checkChat($_GET['code']));
        break;








    case 'my_chat_list':
        $my_chats = $chat->my_chat_list($loggedUser_id);
        echo json_encode($my_chats);

        break;
    case 'get_last_chats' :
//        $new_chats = $chat->get_last_chats($loggedUser_id);
//        $id = $_POST['id'];
//        echo json_encode($id);
        break;
    case 'store' :
        echo json_encode('h');
        break;
    case 'get_city':
        $id = $_GET['id'];
        $cities = $user->get_city($id);
        $result =[];
        if (isset($cities)){
            foreach ($cities as $city){
                $city = (object)$city;
                $result[] = "<option value='$city->id'>$city->name</option>)";
            }
        }
        echo  json_encode($result);

        break;
    case 'checkMobile':
        $user = $user->checkMobile($_GET['mobile']);
        if ($user){
            echo json_encode($user);
        } else {
            echo json_encode($user);
        }
        break;
    case 'loadNote':
        $notes = $notes_obj->load($_GET['chat_code']);
        echo json_encode($notes);

        break;

}