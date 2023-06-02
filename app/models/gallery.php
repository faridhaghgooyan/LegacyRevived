<?php

namespace app\models;
require_once dirname(__DIR__, 3)."/config.php";
class Gallery
{
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    public function index($admin_id , $chat_code){
        try {
            $query = $this->db->query("
            SELECT chats.id ,chats.code , chats.created_at , chats.path , users.firstName , users.lastName 
            FROM chats
            LEFT JOIN users on users.chat_code = chats.code
            WHERE chats.message_type = 'image' && users.consultant_id = $admin_id && chats.code like '%$chat_code%'
            ");
            return  $query->fetchAll();
        } catch (\PDOException $e){
            return $e->getMessage();
        }
    }
}