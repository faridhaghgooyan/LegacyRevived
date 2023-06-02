<?php
namespace app\models;
if (file_exists('app/models/uploader.php')){
    require_once 'app/models/uploader.php';
} else {
    require_once '../app/models/uploader.php';
}
if (file_exists('app/models/users.php')){
    require_once 'app/models/users.php';
} else {
    require_once '../app/models/users.php';
}
if (file_exists('../config.php')){
    require_once '../config.php';
} else {
    require_once '../../config.php';
}
class chat {
    protected $tbl = 'chats';
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function drtoChat($id,$dr_id){

        $this->db->query("UPDATE chat_files SET doctor_id='$dr_id' WHERE id='$id'");
    }
    public  function getChatFile($filename){
        $path = '/chat_history' . $filename . '.json';
        return $path;
    }
//    public function store($data,$user_id,$filetype,$path){
//        $user = new users();
//        date_default_timezone_set('Asia/Tehran');
//        $db_title = $data['userToken'].date('Y-m-d');
//        $file_name = '../chat_history/'.$db_title.'.json';
//        $obj = new uploader();
//        $timestamp= date('Y-m-d');
//        $db_file_name = $db_title.'.json';
//        if ($data['type'] == 'user'){
//            if (file_exists($file_name)){
//                $current_data = file_get_contents($file_name);
//                $array_data = json_decode($current_data,'true');
//
//                $extra = array(
//                    'mac_address'=> $data['mac_address'],
//                    'type'=> $data['type'],
//                    'chat_code'=> $data['chat_code'],
//                    'messageCode'=> rand(),
//                    'text'=> $data['text'],
//                    'fileType'=> $filetype,
//                    'filePath'=> $path,
//                    'timestamp'=>$timestamp
//                );
//
//                $array_data[] = $extra;
//                $final_data = json_encode($array_data);
//                file_put_contents($file_name,$final_data);
//                $obj->update_chat_files($db_file_name,$user_id);
//            }
//            else {
//                $handle = fopen($file_name, 'a+');
//                fclose($handle);
//                $current_data = file_get_contents($file_name);
//                $array_data = json_decode($current_data,'true');
//                $extra = array(
//                    'mac_address'=> $data['mac_address'],
//                    'type'=> $data['type'],
//                    'chat_code'=> $data['chat_code'],
//                    'messageCode'=> rand(),
//                    'text'=> $data['text'],
//                    'fileType'=> $filetype,
//                    'filePath'=> $path,
//                    'timestamp'=>$timestamp
//                );
//                $array_data[] = $extra;
//                $final_data = json_encode($array_data);
//                file_put_contents($file_name,$final_data);
//
//                $obj->chat_files($user_id,$db_title,$db_file_name);
//            }
//        }
//        if ($data['type'] == 'admin') {
//            $handle = fopen($file_name, 'a+');
//            fclose($handle);
//            $current_data = file_get_contents($file_name);
//            $array_data = json_decode($current_data, 'true');
//            $extra = array(
//                'mac_address'=> $data['mac_address'],
//                'type'=> $data['type'],
//                'chat_code'=> $data['chat_code'],
//                'text'=> $data['text'],
//                'fileType'=> $filetype,
//                'filePath'=> $path,
//                'timestamp'=>$timestamp
//            );
//            $array_data[] = $extra;
//            $final_data = json_encode($array_data);
//            file_put_contents($file_name, $final_data);
//        }
//
//    }
    public function adminStore($data,$user_id,$filetype,$path){
        $user = new users();
        date_default_timezone_set('Asia/Tehran');
        $file_name = '../chat_history/'.$data["chatJsonFile"];
        $obj = new uploader();
        $timestamp= date('Y-m-d');
        $db_title = $data['mac_address'].date('Y-m-d');

        $db_file_name = $db_title.'.json';

        if ($data['type'] == 'user'){
            if (file_exists($file_name)){
                $current_data = file_get_contents($file_name);
                $array_data = json_decode($current_data,'true');

                $extra = array(
                    'mac_address'=> $data['mac_address'],
                    'type'=> $data['type'],
                    'chat_code'=> $data['chat_code'],
                    'messageCode'=> rand(),
                    'text'=> $data['text'],
                    'fileType'=> $filetype,
                    'filePath'=> $path,
                    'timestamp'=>$timestamp
                );

                $array_data[] = $extra;
                $final_data = json_encode($array_data);
                file_put_contents($file_name,$final_data);
                $obj->update_chat_files($db_file_name,$user_id);
            }
            else {
                $handle = fopen($file_name, 'a+');
                fclose($handle);
                $current_data = file_get_contents($file_name);
                $array_data = json_decode($current_data,'true');
                $extra = array(
                    'mac_address'=> $data['mac_address'],
                    'type'=> $data['type'],
                    'chat_code'=> $data['chat_code'],
                    'messageCode'=> rand(),
                    'text'=> $data['text'],
                    'fileType'=> $filetype,
                    'filePath'=> $path,
                    'timestamp'=>$timestamp
                );
                $array_data[] = $extra;
                $final_data = json_encode($array_data);
                file_put_contents($file_name,$final_data);

                $obj->chat_files($user_id,$db_title,$db_file_name);
            }
        }
        if ($data['type'] == 'admin') {
            $handle = fopen($file_name, 'a+');
            fclose($handle);
            $current_data = file_get_contents($file_name);
            $array_data = json_decode($current_data, 'true');
            $extra = array(
                'mac_address'=> $data['mac_address'],
                'type'=> $data['type'],
                'chat_code'=> $data['chat_code'],
                'text'=> $data['text'],
                'fileType'=> $filetype,
                'filePath'=> $path,
                'timestamp'=>$timestamp
            );
            $array_data[] = $extra;
            $final_data = json_encode($array_data);
            file_put_contents($file_name, $final_data);
        }

    }
    public function chatStore($data){
        $user_email = $data["user_email"];
        $mac_address = $data["mac_address"];
        $chat_code = $data["chat_code"];
        $roll = $data["type"];
        $text = $data["text"];
        $file_type = 'NULL';
        $file_path = 'NULL';
        $this->db->query("INSERT INTO test(user_email,mac_address,chat_code,roll,text,file_type,file_path) VALUES ('$user_email','$mac_address','$chat_code','$roll','$text','$file_type','$file_path')");
    }
    public function add_to_consultant($chatFile,$consultant_id,$customer_id){
        $this->db->query("update chat_files set owner=$consultant_id where file_name='$chatFile'");
        $this->db->query("insert into customer_admin (customer_id,admin_id) values($customer_id,$consultant_id)");
    }
    public function addToSupporter($fileName,$supporter,$message){
        $this->db->query("update chat_files set owner = null , supporter_id=$supporter ,message ='$message'  where file_name='$fileName'");
    }
    public function findChat($fileName){
        $query = $this->db->query("select * from chat_files where title = '$fileName'");
        return $query->fetch();
    }
    public function get_users_chats($id): array
    {
        $query = $this->db->query("select * from chats where user_id=$id group by code");
        return $query->fetchAll();
    }
    // Admin Functions
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
    public function consultant_new_chat($id): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where owner_id = $id and  has_seen = 0");
        return $query->fetchAll();
    }
    public function get_last_chats($owner_id,$id)
    {
        try {
            $query = $this->db->query("SELECT *, COUNT(*) as rowCount FROM $this->tbl
        where  id > $id and owner_id =$owner_id and admin_check = 0 group by code  ");
            $result =  $query->fetchAll();
            return $result;
        }
        catch (\PDOException $e){
            echo $e->getMessage();
        }

    }
    public function change_admin_check($owner_id){
        $this->db->query("UPDATE $this->tbl SET admin_check  = '1' where owner_id = $owner_id");
    }
    public function rest_has_show($owner_id)
    {
        $this->db->query("UPDATE $this->tbl SET admin_check  = 0 WHERE owner_id = $owner_id");
    }
    public function my_chat_list($owner_id): array
    {
        $query = $this->db->query("SELECT *, COUNT(*) as rowCount FROM $this->tbl
        where  owner_id = $owner_id  group by code");
        return $query->fetchAll();

    }
    public function get_chats($code): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where code = $code");
        return $query->fetchAll();
    }
    public function update_admin_chat($code,$id): array
    {
        $query = $this->db->query("SELECT * FROM '$this->tbl' where code = $code and admin_check = 0 and id > $id");
        $this->db->query("UPDATE $this->tbl SET admin_check  = '1' where code = $code and admin_check = 0");

        return $query->fetchAll();
    }
    public function storeMessage($data): bool
    {
        try {
            $this->db->query("INSERT INTO $this->tbl(code,message,message_type,path,user_type,user_id,owner_id)
            values (
                    '$data->code',
                    '$data->message',
                    '$data->message_type',
                    '$data->path',
                    '$data->user_type',
                    '$data->user_id',
                    '$data->owner_id'
            )");
            return true;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    public function get_chat_user($owner_id)
    {
        $query = $this->db->query("
        SELECT chats.* , users.id , users.firstName , users.lastName
        from $this->tbl
        left join users on users.id = chats.user_id
        where chats.owner_id = $owner_id and chats.user_id = users.id
        ");
    }
    public function my_customers($id): array
    {
        $query = $this->db->query("
        SELECT user_admin.* , users.*
        FROM user_admin
        LEFT JOIN users on users.id = user_admin.customer_id
        where user_admin.admin_id = $id
        ");
        return $query->fetchAll();
    }
    // Customer Functions
    public function store($data)
    {
        $data->token = $data->token ?? 'none';

        try {
            $this->db->query("INSERT INTO $this->tbl(code,message,message_type,user_id,owner_id,path,user_type,token)
            values (
                    '$data->code',
                    '$data->message',
                    '$data->message_type',
                    '$data->user_id',
                    '$data->consultant_id',
                    '$data->path',
                    '$data->user_type',
                    '$data->token'
            )");
            return $this->db->lastInsertId();
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function get_chat($id){
        $query = $this->db->query("SELECT * FROM $this->tbl where id = $id");
        return $query->fetch();
    }
    public function update_user_chat($code,$id): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where code = $code and user_check = 0 and id > $id");
        $this->db->query("UPDATE $this->tbl SET user_check  = '1' where code = $code and user_check = 0 and id > $id");

        return $query->fetchAll();
    }
    public function getHistory($code)
    {
        try {
            $query = $this->db->query("select * from $this->tbl where code = '$code'");
            return $query->fetchAll();
        }
        catch (\PDOException $e){
            echo $e->getMessage();
            return  false;
        }
    }
    public function chat_seen($code)
    {
        $this->db->query("update $this->tbl set has_seen = 1 where code = '$code'");
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
    public function get_history($user_id): array
    {
        $query = $this->db->query("SELECT * FROM $this->tbl where user_id = $user_id order by id desc");
        return $query->fetchAll();
    }
}