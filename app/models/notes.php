<?php
namespace app\models;
require_once dirname(__DIR__, 3)."/config.php";

class notes{
    protected $tbl = 'notes';
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function create($code,$message,$fa_time,$fa_date){
        try {
            $this->db->query("insert into $this->tbl(chat_code,text,fa_time,fa_date)
            values (
                    '$code',
                    '$message',
                    '$fa_time',
                    '$fa_date'
                    )");
            return true;
        } catch (\PDOException $e){
            return  $e->getMessage();
        }
    }
    public function list($chat_code , $offset){
        try {
            $query = $this->db->query("
                SELECT notes.* , users.*
                from $this->tbl
                LEFT JOIN users on users.chat_code = notes.chat_code
                WHERE notes.chat_code = $chat_code
                order by notes.id desc
                limit 5
                offset $offset
            ");
            return $query->fetchAll();
        } catch (\PDOException $e){
            return $e->getMessage();
        }
    }
    public function read($id){
        $query = $this->db->query("select * from $this->tbl where id=$id");
        return $query->fetch();
    }
    public function update($text,$id){

        $this->db->query("update $this->tbl set text = '$text' where id = $id");
    }
    public function delete($id){
        $this->db->query("delete from $this->tbl where id=$id");
    }
    public function load($code): array
    {
        $query = $this->db->query("
        SELECT notes.* , users.*
        from $this->tbl
        LEFT JOIN users on users.chat_code = notes.chat_code
        WHERE notes.chat_code = $code
        ");
        return $query->fetchAll();
    }
    public function get_notes($code): array
    {
        $query = $this->db->query("
        SELECT notes.* , users.*
        from $this->tbl
        LEFT JOIN users on users.chat_code = notes.chat_code
        WHERE notes.chat_code = $code 
        ");
        return $query->fetchAll();
    }



}