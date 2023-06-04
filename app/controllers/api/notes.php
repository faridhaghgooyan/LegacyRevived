<?php
use App\Model\chat;
use App\Model\uploader;
use App\Model\service;
use App\Model\dateConverter;
use App\Model\note;
require_once '../app/models/uploader.php';
require_once '../app/models/chat.php';
require_once '../app/models/users.php';
require_once '../app/models/services.php';
require_once '../app/models/admin.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/notes.php';
$uploader = new uploader();
$chat = new chat();
$user = new users();
$services_obj = new service();
$admin_obj = new admin();
$dateConverter = new dateConverter();
$notes_obj = new note();
switch ($action){
    case 'store':


        $_POST['created_at'] = date('Y-m-d H:i:s');
        $_POST['date'] = $dateConverter->date_convert(date('Y-m-d H:i:s'),'jalali')[0]['date'];
        $_POST['time'] = $dateConverter->date_convert(date('Y-m-d H:i:s'),'jalali')[0]['time'];
        $data = array(
            'chat_code'=> $_GET['chat_code'],
            'text'=> $_GET['text'],
            'date'=> $_POST['date'],
            'time'=> $_POST['time']
        );
        $notes_obj->create($_GET['chat_code'],$_GET['text'],$_POST['time'],$_POST['date']);
        echo json_encode($data);
        break;
    case 'getNote':
        $notes = $notes_obj->get_notes($_GET['chat_code']);
        echo json_encode($notes);

        break;


}