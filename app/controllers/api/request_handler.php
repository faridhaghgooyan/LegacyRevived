<?php

require_once "../../Model/users.php";
require_once "../../Model/sms.php";
require_once "../../Model/code.php";
use App\Model\sms;

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    switch ($_GET['action']){
        case "login":
            echo json_encode($_POST);
            break;
    }
} elseif($_SERVER['REQUEST_METHOD'] == "POST"){

    switch ($_POST['action']){
        case "login":
            if (empty($_POST['mobile']) || empty($_POST['password'])){
                $response = array(
                    "error"=>"وارد کردن شماره همراه و رمز عبور لازم میباشد!"
                );
                echo json_encode($response);
            } else {
                try {
                    $controller = new users();
                    $user = $controller->login($_POST['mobile']);
                    $password = sha1($_POST['password']);
                    $mobile = $_POST['mobile'];

                    if (!is_null($user['token'])){

                        if ($user && $user['token'] == $password){
                            setcookie("TF-Mobile", $mobile, time()+(86400 * 30),'/');
                        }
                        echo json_encode(true);

                    } else {
                        if ($user && $user['password'] == $password){
                            setcookie("TF-Mobile", $mobile, time()+(86400 * 30),'/');
                        }
                        echo json_encode(true);

                    }
//                    $controller->modify([
//                        "token"=> NULL,
//                        "id"=> $user['id'],
//                    ]);
                }catch (Exception $e){
                    echo json_encode(["error"=>"مشکلی پیش آمده ، مجددا تلاش کنید!"]);
                };
            }
            break;
        case "forgetpassword":
            try {
                $controller = new users();
                $user = $controller->login($_POST['mobile']);
                $sms_obj = new Sms();
                $code = new Code();
                $code = $code->forget_password_code();
                $sms_obj->forget_password($user['mobile'],$code);
                $controller->modify([
                    "token"=> sha1($code),
                    "id"=> $user['id'],
                ]);
                echo json_encode(["success"=>"رمز عبور موقت برای شما ارسال شد"]);
            }catch (Exception $e){
                echo json_encode(["error"=>"مشکلی پیش آمده ، مجددا تلاش کنید!"]);
            };
            break;
        case "register":
            if (empty($_POST['mobile']) || empty($_POST['password'])){
                $response = array(
                    "error"=>"وارد کردن شماره همراه و رمز عبور لازم میباشد!"
                );

                echo json_encode($response);
            } else {
                try {

                    $controller = new users();
                    $user = $controller->findByMobile($_POST['mobile']);
                    if ($user){
                        $response = array(
                            "error"=>"شماره همراه وارد شده تکراری میباشد!"
                        );
                        echo json_encode($response);
                    } else {
                        $_POST['password'] = sha1($_POST['password']);
                        $_POST['code'] = rand(111111,999999);
                        $user_id = $controller->register((object)$_POST);
                        $user = $controller->find($user_id);
                        setcookie("TF-Mobile", $user['mobile'], time()+(86400 * 30),'/');
                        echo json_encode(true);

                    }

                }catch (Exception $e){
                    echo json_encode(["error"=>"مشکلی پیش آمده ، مجددا تلاش کنید!"]);
                };
            }
            break;
    }
}