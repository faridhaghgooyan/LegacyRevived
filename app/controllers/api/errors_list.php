<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['action'] == 'errorsList'){
    $errors = [
        "100"=>"رمز عبور و تکرار رمز عبور یکسان نمیباشد!",
    ];
    foreach ($errors as $key => $value){
        if ($key == $_GET['errCode']){
            echo json_encode($value);
        }
    }
}