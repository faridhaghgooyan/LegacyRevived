<?php


include_once "../../config.php";
include "../../includes.php";


use App\Model\main;
use App\Model\service;
include_once "../app/Model/users.php";
include_once "../app/Model/main.php";
include_once "../app/Model/permissions.php";
include_once "../app/Model/main.php";
include_once "../app/Model/services.php";
// Global Functions

$user = new users();
$main = new main();
$permission = new permissions();
$services_obj = new service();
//if (isset($_GET['code'])){
//    $customer = $user->loginByCode($_GET['code']);
//    if ($customer){
//
//        $mobile = $customer['mobile'];
//        setcookie("TF-Mobile", $mobile, time()+3600);
//        header('location:/user?c=index&a=index');
//    }
//}


//if (!isset($_COOKIE["TF-Mobile"]) and !isset($_GET['api']) || $_GET['code']) {
//    header('location:login.php');
//}

// Global Variables
if (isset($_COOKIE["TF-Mobile"])) {
    $count = $main->ticketsCount();
    // User Quick Info
    $user_info = $user->findByMobile($_COOKIE['TF-Mobile']);
    $userToken = $user->findByMobile($_COOKIE['TF-Mobile'])['token'];
    $loggedUser_id = $user->findByMobile($_COOKIE['TF-Mobile'])['id'];
    $loggedUser_pic = $user->findByMobile($_COOKIE['TF-Mobile'])['pic'];
    $user_roll = $user->findByMobile($_COOKIE['TF-Mobile'])['roll'];
    $user_roll_title = $user->findRoll($user_roll)['title'];
    $user_roll_faTitle = $user->findRoll($user_roll)['fa_title'];
    $userName = $user->findByMobile($_COOKIE["TF-Mobile"])['firstName'].' '.$user->findByMobile($_COOKIE["TF-Mobile"])['lastName'];
    // Public Info
//    $month_list = main::month_list();
    $services_list = $services_obj->list();
    $totalPayment = $user->totalPayments($loggedUser_id);
    $payments = $user->getPayments($loggedUser_id);
    $tasks = $user->getTasks($loggedUser_id);
    $invoices = $user->get_invoices($loggedUser_id);
    $service_req = $services_obj->get_user_req($loggedUser_id);

    if (isset($_COOKIE['Customer-Code'])){
        $consultant_id = $user->loginByCode($_COOKIE['Customer-Code'])['consultant_id'];
    }
} else {
    $user_roll = 9;
}


// $access = $permission->admin();
// if(!in_array($action,$access)){
//     header('location:/admin/?c=index&a=index');
// }




$controller=@$_GET["c"]?$_GET["c"]:"index";
$api=@$_GET["api"]?$_GET["api"]:"index";
$action=@$_GET["a"]?$_GET["a"]:"index";

require_once "../app/controllers/user/$controller.php";
if (isset($_COOKIE['Customer-Token']) and isset($_GET["api"])){
    require_once "../app/controllers/api/$api.php";
}

//var_dump($_GET);die();
// Check User Permissions
switch (array_keys($_GET)[0]){
    case 'api' :
        $access = $permission->checkPermission($user_roll,$api,$action);
        break;
    case 'c':
        $access = $permission->checkPermission($user_roll,$controller,$action);
        break;
}
if ($access){

    if ($api != 'index') {

        require_once "../app/controllers/api/$api.php";

    } else if ($controller) {

        if(file_exists("../app/controllers/user/$controller.php")){
            if (!isset($_COOKIE['TF-Mobile'])){
                header('location:/');
            }
            include_once "section/header.php";
            include_once "section/scripts.php";
            require_once "$controller/$action.php";
            require_once "../app/controllers/user/$controller.php";
            // Check User Roll
            include_once "section/footer.php";

        }
    }
} else {
//    header('location:/admin/?c=index&a=index');
}




//include_once "view/layout/footer.php";

?>

