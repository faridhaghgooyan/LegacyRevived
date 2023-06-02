<?php
use app\models\dateConverter;
use app\models\drafts;
require_once '../app/models/dateConverter.php';
require_once '../app/models/drafts.php';

$dateCovert = new dateConverter();
$drafts_obj = new drafts();

switch ($action){
    case 'create':
        $drafts_obj->create($_POST["text"],$_POST["code"]);
        header('location:?c=drafts&a=list');
        break;
    case 'read':
        $draft = $drafts_obj->read($_GET['id']);
        break;
    case 'update':
        $drafts_obj->update($_POST["text"],$_GET['id']);
        header('location:?c=drafts&a=list');
        break;
    case 'delete':
        $drafts_obj->delete($_GET["id"]);
        header('location:?c=drafts&a=list');

        break;
    case 'list':
        $sms_list = $drafts_obj->list();
        break;
}