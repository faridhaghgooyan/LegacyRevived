<?php
use App\Model\user;
use App\Model\uploader;
use App\Model\ticket;

require_once '../app/models/users.php';
require_once '../app/models/uploader.php';
require_once '../app/models/ticket.php';

$users_obj = new user();
$uploader = new uploader();
$ticket_obj = new ticket();

switch ($action){
    case 'show' :
        $code = $_GET['code'];
        $tickets = $ticket_obj->ticketbyCode($code);

        $users = $users_obj->users_list();
        $ticket_obj->status($code);

        break;
    case 'add' :
        $users = $users_obj->users_list();
        break;
    case 'store' :
        $user_id = $_POST['users_id'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $file = $_FILES['pticketfile'];
//        $upload = $uploader->upload();
        $ticket = $ticket_obj->store_ticket($user_id,$title,$text);
        header('location:?c=ticket&a=list');
        break;
    case 'update' :
        $path = NULL;
        if ($_FILES['ticketfile']['size'] > 0){
            $path = $uploader->upload($_FILES['ticketfile']);
        }
        $data = $_POST['data'];
        $ticket_obj->update($data,$path);
        $code=$data['code'];
        break;
    case 'list' :
        $tickets = $ticket_obj->list_ticket();
        $user = new user();
        break;
}