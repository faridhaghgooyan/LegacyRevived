<?php
namespace App\Model;
use Kavenegar\KavenegarApi;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
class Sms extends KavenegarApi{
    protected $api_key = "363443613448674E5A5A33357463473247494674547A71686C737443624D4143534C6A5751507952614E593D";
    protected $api;
    public function __construct(){
        global $db;
        $this->db = $db;
        $this->api = new KavenegarApi($this->api_key);
    }
    function code01($receptor,$token1,$templateNo){
        try{
            $result = $this->api->VerifyLookup($receptor,$token1,'','',$templateNo);
            if($result){
                var_dump($result);
            }
        }
        catch(ApiException $e){
            echo $e->errorMessage();
        }
        catch(HttpException $e){
            echo $e->errorMessage();
        }
    }
    function forget_password($receptor,$token1){
        try{

            $result = $this->api->VerifyLookup($receptor,"$token1","$token1",'','forgetPassword');
//            if($result){
//                var_dump($result);
//            }
        }
        catch(ApiException $e){
            echo $e->errorMessage();
        }
        catch(HttpException $e){
            echo $e->errorMessage();
        }
    }
    function sendNow($receptor,$template,$token1,$token2 = null , $token3 = null){

        try{

            $result = $this->api->VerifyLookup($receptor,$token1,$token2,"","$template");
//            if($result){
//                var_dump($result);
//            }
        }
        catch(ApiException $e){
            echo $e->errorMessage();
        }
        catch(HttpException $e){
            echo $e->errorMessage();
        }
    }
    function sendLink($receptor,$token1 = null,$token2 = null,$token3 = null,$templateNo){
        try{
            $result = $this->api->VerifyLookup(
                $receptor,
                $token1,
                $token2,
                $token3,
                $templateNo
            );
            if($result){
                var_dump($result);
            }
        }
        catch(ApiException $e){
            echo $e->errorMessage();
        }
        catch(HttpException $e){
            echo $e->errorMessage();
        }
    }

}