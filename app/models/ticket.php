<?php
namespace app\models;
if (file_exists('../config.php')){
    require_once '../config.php';
} else {
    require_once '../../config.php';
}
class ticket{
    public function __construct(){
        global $db;
        global $table;
        $this->db = $db;
        $table = 'ticket';
    }
    public function store_ticket($data){
        if( $data["title"] == ''){
            $title = '';
        } else {
            $title = $data["title"];
        }

        $text = $data["text"];
        $user_id = $data["user_id"];
        $code = $data["code"];
        if ($code === '0'){
            $code = uniqid();
        }
        $this->db->query("insert into tickets(user_id,title,text,code) values ('$user_id','$title','$text','$code') ");

    }
    public function user_Tickets($userID){
        $query = $this->db->query("select * from tickets where user_id=$userID order by id desc");
        return $query->fetchAll();
    }
    public function list_ticket(){
        $query = $this->db->query('select * from tickets order by id DESC');
        $result = $query->fetchAll();
        return $result;
    }
    public function ticketbyCode($code){
        $query = $this->db->query("select roll , text , file from tickets where code='$code'");
        $result = $query->fetchAll();
        return $result;
    }
    public function update($data,$path){
        $text = $data['text'];
        $roll = $data['roll'];
        $code = $data['code'];
        $this->db->query("INSERT INTO tickets(text,roll,file,code) VALUES ('$text','$roll','$path','$code')");
    }
    public function status($code){
        $this->db->query("update tickets set status=1 where code='$code'");
    }
    public function findTicket($code){
        $query = $this->db->query("select * from tickets where code='$code'");
        return $query->fetchAll();
    }
}