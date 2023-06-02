<?php
use app\models\chat;
use app\models\uploader;
use app\models\users;
require_once '../app/models/uploader.php';
require_once '../app/models/chat.php';
require_once '../app/models/users.php';
$uploader = new uploader();
$chat = new chat();
$user = new users();
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
        $chat->store($_POST,$loggedUser_id,$filetype,$path);
        break;

    case 'createChat':
        echo '<pre>', var_dump($_POST),'</pre>';
        $chat->store($_POST,$loggedUser_id);
        break;
}