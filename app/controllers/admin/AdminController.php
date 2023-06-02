<?php
use app\models\admin;
require_once '../models/admin.php';

$object = new admin();
$email = $_POST['email'];
$pass  = sha1($_POST['password']);
$result = $object->adminUsers($email);
if ($email == $result['email'] && $pass == $result['password']){
    session_start();
    $_SESSION['email'] = $email;
    header('location:../../admin/dashboard');
} else {
    header('location:../../admin/login');
}
