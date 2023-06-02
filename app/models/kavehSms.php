<?php
namespace app\models;
if (file_exists('../config.php')){
    require_once '../config.php';
    require '/vendor/autoload.php';


} else {
    require_once '../../config.php';
    require '../vendor/autoload.php';

}

class kavehSms{
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function create($text,$code){
        $this->db->query("insert into sms(text,code) values ('$text',$code)");
    }
    public function list(){
        $query = $this->db->query("select * from sms order by code");
        return $query->fetchAll();
    }
    public function read($id){
        $query = $this->db->query("select * from sms where id=$id");
        return $query->fetch();
    }
    public function update($text ,$code,$id){

        $this->db->query("update sms set text = '$text', code = $code where id = $id");
    }
    public function delete($id){
        $this->db->query("delete from sms where id=$id");
    }
    public function sendSMS($receptor,$message){
        $sender = "10004346";
        $api = new \Kavenegar\KavenegarApi("363443613448674E5A5A33357463473247494674547A71686C737443624D4143534C6A5751507952614E593D");

        $api -> Send ( $sender,$receptor,$message);
    }
    public function reset_password($receptor){
        $query = $this->db->query("select * from users where mobile ='$receptor'");
        $user = $query->fetch();
        $userName = $user['firstName'] . ' ' . $user['lastName'];
        if ($receptor){
            $sender = "1000596446";
            $uniqCode = mt_rand(100000,999999);
            $uniqCodeHash = md5($uniqCode);
            $message = $userName . 'عزیز ، کد فعال سازی شما :
            ' . $uniqCode . '
            کلینیک زیبایی توت فرنگی
            ';
            $api = new \Kavenegar\KavenegarApi("4D484D4B39304E5A4948316345315A584C384548726677346B39494769727547495A37306E534F734D4B303D");
            $api -> Send ( $sender,$receptor,$message);
            $this->db->query("update users set forgot_pass_identity='$uniqCodeHash' where mobile='$receptor'");
        } else {
            return json_encode('کاربری وجود ندارد!');
        }


    }
    public function vote_sms($receptor,$task_id,$nurse_name){
        $query = $this->db->query("select * from users where mobile ='$receptor'");
        $user = $query->fetch();
        $userName = $user['firstName'] . ' ' . $user['lastName'];
        $sender = "1000596446";
        $link = 'https://clog.tootfarangee.com/vote/?task=' . $task_id;
        $message = $userName.' عزیز ،
        نظر شما درباره خدمات پرستار ' .$nurse_name. ' چه بود ؟
        لطفا آن را با ما به اشتراک بگذارید.روی لینک زیر کلیک کنید :  
        '.$link;
        $api = new \Kavenegar\KavenegarApi("4D484D4B39304E5A4948316345315A584C384548726677346B39494769727547495A37306E534F734D4B303D");
        $api -> Send ( $sender,$receptor,$message);


    }
    public function find_sms($code) : array{
        $query = $this->db->query("select * from sms where code = $code");
        return $query->fetchAll();
    }
}