<?php
use App\Model\doctor;
use App\Model\uploader;
use App\Model\service;
use App\Model\chat;
use App\Model\dateConverter;
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/uploader.php';
require_once '../app/models/services.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/chat.php';
$user_obj = new users();
$dr_obj = new doctor();
$uploader = new uploader();
$services_obj = new service();
$date_converter = new dateConverter();
$chat_obj = new chat();
switch ($action){

    case 'find':
        $id = $_GET['id'];
        $data = $user_obj->find($id);
        echo json_encode($data);
        break;

    case 'cities':
        $province_id = $_GET["id"];
        echo json_encode($user_obj->cities($province_id));
//        $province_id = $_POST["province_id"];
//        $cities = $obj->cities($province_id);
        break;
    case 'chatFiles' :
        $user_id = $_GET['id'];
        echo json_encode($user_obj->userChatFiles($user_id));
        break;
    case 'consultant':
        $consultants = $user_obj->consultant_list();
        json_encode($consultants);
        break;
    case 'getComment' :
        if ($user->getComments($_GET['id'])){
            echo json_encode($user->getComments($_GET['id']));
        }
        break;
        case 'supporterComment' :
        if ($user->supporterComment($_GET['id'])){
            echo json_encode($user->getComments($_GET['id']));
        }
        break;
    case 'showService' :
        $service = $services_obj->find($_GET['id']);
        echo json_encode($service);
        break;
    case 'forget_password':
        echo 'gsgd';
        break;
    case 'checkResetCode':
        echo json_encode($_POST);
    break;
    case 'store':
        switch ($_POST['message_type']){
            case 'text':
                $_POST['path'] = $_POST['user_id'] = null;
                $_POST['owner_id'] = 162;
                $_POST['path'] = null;
                $_POST['user_id'] = $loggedUser_id;
                $query = $chat_obj->create((object)$_POST);
                $last_row = $chat_obj->get_chat($query);
                $fa_date = $date_converter->dateConvert($last_row['created_at'])[0]['time'];
                $last_row['created_at'] = $fa_date;
                if ($query){
                    echo json_encode($last_row);
                } else {
                    echo json_encode('403');
                }
                break;
            case 'image':
                if (isset($_FILES['file']) && $_FILES['file']['size'] > 0){
                    $path = $uploader->fileUpload($_FILES['file'],'chat');
                    $_POST['path'] = $path;
                    $_POST['message'] = $_POST['user_id'] =  null;
                    $_POST['owner_id'] = 162;
                    $query = $chat_obj->store((object)$_POST);
                    if ($query){
                        echo json_encode($_POST);
                    } else {
                        echo json_encode('403');
                    }
                }
                break;
        }

        break;
    case 'getHistory':
        if (isset($_POST['code'])){
            $messages = $chat_obj->getHistory($_POST['code']);
        }
        if ($messages){
            $result = [];
            foreach ($messages as $key => $value){
                if ($value['created_at']){
                    $value['created_at'] = $date_converter->dateConvert($value['created_at'])[0]['time'];;
                }
                $result[$key] = $value;
            }
            echo json_encode($result);
        }


        break;
    case 'update_chat':
        $news = $chat_obj->update_user_chat($_GET['code'],$_GET['rowID']);
        echo json_encode($news);
        break;






}