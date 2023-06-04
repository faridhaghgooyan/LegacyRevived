<?php
use App\Model\user;
use App\Model\permissions;
use App\Model\dateConverter;
use App\Model\kavehSms;
use App\Model\note;
require_once '../app/models/users.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/kavehSms.php';
require_once '../app/models/notes.php';
$notes_obj = new note();
$dateCovert = new dateConverter();


switch ($action){
    case 'add':
        header('location:?c=notes&a=list');

    break;
    case 'store':
        $_POST['user_id'] = $loggedUser_id;
        $notes_obj->create((object)$_POST);
        header('location:?c=notes&a=list');
        break;
    case 'read':
        $note = $notes_obj->read($_GET['id']);
        break;
    case 'update':
        $notes_obj->update($_POST["text"],$_GET['id']);
        header('location:?c=notes&a=list');
        break;
    case 'delete':
        $notes_obj->delete($_GET["id"]);
        header('location:?c=notes&a=list');

        break;
    case 'list':
        $notes = $notes_obj->list($admin_info->id);
        break;

}