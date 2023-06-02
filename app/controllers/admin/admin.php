<?php
use app\models\doctors;
use app\models\uploader;
use app\models\dateConverter;
use app\models\finance;
use app\models\chat;
require_once '../app/models/admin.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/uploader.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/finance.php';
require_once '../app/models/chat.php';
require_once '../app/models/permissions.php';
$admin_obj = new admin();
$user_obj = new users();
$dr_obj = new doctors();
$uploader = new uploader();
$permission_obj = new permissions();
$finance_obj = new finance();
$chat_obj = new chat();


switch ($action){
    case 'login':
        $email = strtolower($_POST['email']);
        $pass = strtolower(sha1($_POST['password']));

        $admin = $admin_obj->login($email);

        if ($admin['email'] == $email && $admin['password'] == $pass){
            setcookie("TF-Email", $email, time()+(86400 * 30));
            header('location:?c=index&a=index');
        } else {
            echo '<script>alert("نام کاربری یا رمز عبور میباشد!")</script>';
            header('location:/admin/login.php');
        }
        break;
    case 'add':
        $rolls = $admin_obj->rolls_list();
        break;
    case 'list':
        $admins = $admin_obj->list();

        break;
    case 'create':
        if (isset($_FILES['profilepic'])){
            $profile = $uploader->fileUpload($_FILES['profilepic'],'profile');
            if ($profile){
                $_POST['profile'] = $profile;
            }
        }
        $_POST['password'] = strtolower(sha1($_POST['password']));
        $_POST['email'] = strtolower($_POST['email']);
        $admin_obj->create((object)$_POST);
        header('location:?c=admin&a=list');
        break;
    case 'edit':
        $rolls = $admin_obj->rolls_list();
        $admin = $admin_obj->find($_GET['id']);
        break;
    case 'update':
        $pic = '/storage/noimage.jpg';
        if (isset($_FILES["profilepic"]) and $_FILES["profilepic"]["size"] > 0){
            $pic = $uploader->fileUpload($_FILES["profilepic"], 'profile');
        }
        $admin_obj->update((object)$_POST,$pic);
        header('location:?c=admin&a=list');
        break;
    case 'delete':

        $admin_obj->delete($_GET['id']);
        header('location:?c=admin&a=list');
        break;




}