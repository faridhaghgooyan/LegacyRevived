<?php
namespace app\models;
class chat {
    protected $tbl = 'chats';
    public function __construct(){
        global $db;
        $this->db = $db;
    }


    public function store($data){
        try {
            $this->db->query("INSERT INTO chats(`code`,`message`,`message_type`,`path`,`user_type`, `user_id`)
            VALUES ('$data->code','$data->message','$data->message_type','$data->path','$data->user_type','$data->user_id')");
            return true;
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
    public function get_new_chat($code,$user_type){
        $query = $this->db->query("SELECT * FROM chats where code = '$code' && user_type = '$user_type' && has_seen = 0");
        return $query->fetchAll();
    }
    public function get_by_type($user_id , $type = 'image'){
        $query = $this->db->query("SELECT * FROM chats where user_id = '$user_id' && message_type = '$type'
        order by id desc
");
        return $query->fetchAll();
    }
    public function get_old_chat($code,$offset){
        $query = $this->db->query("SELECT * FROM chats where code = '$code' order by id desc limit 5 offset $offset ");
        return $query->fetchAll();
    }
    public function update_new_chats($ids){
        $string_ids = implode(",",$ids);
        try {
            $this->db->query("UPDATE chats set has_seen = 1 where id in ($string_ids)");
            return true;
        } catch (\Exception $e){
            return  $e->getMessage();
        }
    }
















    public function create($data): bool
    {
        try {
            $this->db->query("INSERT INTO $this->tbl(code,message,message_type,path,user_type,user_id,owner_id,fa_time,fa_date)
            values (
                    '$data->code',
                    '$data->message',
                    '$data->message_type',
                    '$data->path',
                    '$data->user_type',
                    '$data->user_id',
                    '$data->owner_id',
                    '$data->fa_time',
                    '$data->fa_date'
            )");
            return true;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    public function chat_list($owner_id): array
    {

        try {
            $query = $this->db->query("SELECT chats.* , users.* FROM $this->tbl
        left join users on users.chat_code = chats.code
        WHERE chats.owner_id = $owner_id group by chats.code order by chats.id desc");
            return $query->fetchAll();
        }catch (\PDOException $e){
            die($e->getMessage());
        }
    }
    public function site_admin_chats(): array
    {
       $query = $this->db->query("SELECT * FROM chats WHERE owner_id is null and user_id = 0 group by code");
       return $query->fetchAll();
    }
    public function get_chats($code): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where code = $code");
        return $query->fetchAll();
    }
    public function get_admin_chats($code): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where code = '$code'");
        return $query->fetchAll();
    }
    public function chat_seen($code)
    {
        $this->db->query("update $this->tbl set has_seen = 1 where code = '$code'");
    }
    public function has_seen($id)
    {
        $this->db->query("update $this->tbl set has_seen = 1 where id = $id");
    }
    public function new_chat(): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where owner_id is null group by code order by id desc");
        return $query->fetchAll();
    }
    public function admin_new_chat(): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where owner_id is null and `created_at`>= NOW() - INTERVAL 1 DAY group by code order by id desc");
        return $query->fetchAll();
    }
    public function checkChat($code): bool
    {
        try {
            $query = $this->db->query("select * from chats where code = '$code' and has_seen = 0");
            $result =  $query->fetchAll();
            if (count($result) > 0){
                return true;
            } else {
                return false;
            }
        }
        catch (\PDOException $e){
            echo  $e->getMessage();
        }
    }
    public function consultant_new_chats($admin_id): array
    {
        try {
            $query = $this->db->query("
            SELECT chats.* , users.id as user_id , users.firstName as firstName , users.lastName as lastName
            from chats
            LEFT JOIN users on users.chat_code = chats.code
            WHERE chats.has_seen = 0  and chats.owner_id = $admin_id and chats.user_type != 'consultant'  GROUP BY chats.code
            ");
            return $query->fetchAll();
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function admin_new_chats(): array
    {
        try {
            $query = $this->db->query("
            SELECT chats.* , users.id as user_id , users.firstName as firstName , users.lastName as lastName
            from chats
            LEFT JOIN users on users.chat_code = chats.code
            WHERE chats.has_seen = 0  and chats.owner_id = 0 and chats.user_type != 'site_admin' GROUP BY chats.code
            ");
            return $query->fetchAll();
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function user_new_chats(): array
    {
        try {
            $query = $this->db->query("
            SELECT chats.* , users.id as user_id , users.firstName as firstName , users.lastName as lastName
            from chats
            LEFT JOIN users on users.chat_code = chats.code
            WHERE chats.has_seen = 0  and chats.owner_id = 0 and chats.user_type != 'guest' and chats.user_type != 'user' GROUP BY chats.code
            ");
            return $query->fetchAll();
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function get_users_chats($id): array
    {
        $query = $this->db->query("select * from chats where user_id=$id group by code");
        return $query->fetchAll();
    }
    public function get_history($user_id): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where user_id = $user_id order by id desc");
        return $query->fetchAll();
    }
    public function to_gallery($id,$status)
    {
        $this->db->query("UPDATE $this->tbl SET add_gallery = $status where id = $id");
    }
    public function user_efile($id)
    {
        try {
            $query = $this->db->query("
            SELECT users.* , user_efile.* , user_efile.id as efile_id , chats.* , chats.id as chat_id
            from users
            LEFT JOIN user_efile on user_efile.id = users.details
            LEFT JOIN chats on chats.code = users.chat_code
            WHERE users.id = $id
            ");
            return $query->fetchAll();
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
        }
    }


}
