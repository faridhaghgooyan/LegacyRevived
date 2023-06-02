<?php
namespace app\models;
require_once dirname(__DIR__, 3)."/config.php";

class todo{
    public function __construct(){
        global $db;
        global $table;
        $this->db = $db;
        $table = 'ticket';
    }
    public function create($data,$due_date){
        $message = $data["message"];
        $customer_id = $data["customer_id"];
        $chat_files = $data["chat_files"];
        $this->db->query("insert into todo_list (message,customer_id,chat_file,due_date) values ('$message',$customer_id,'$chat_files','$due_date')");
    }
    public function newTodo($id){

        $query = $this->db->query("
        select todo_list.* , users.firstName as first_name , users.chat_code as chat_code , users.lastName as last_name , users.chat_code as chat_code
from todo_list
        left join users on users.id = todo_list.customer_id
        where todo_list.has_done = 0 and todo_list.creator_id = $id
");
        return $query->fetchAll();
    }
    public function todoShow($id){
        $this->db->query("update todo_list set notif = 1 where id = $id");

    }
    public function edit($id){
        $query = $this->db->query("
        select todo_list.* , users.firstName as user_firstName , users.chat_code as chat_code ,
       users.lastName as lastName , users.id as user_id
       from todo_list
        left join users on users.id = todo_list.customer_id
        where todo_list.id = $id 
");

        return $query->fetch();
    }
    public function todo_list($creator_id): array
    {
        $query = $this->db->query("
        select todo_list.* , users.firstName as user_firstName ,users.chat_code as chat_code ,
       users.lastName as lastName , users.id as user_id
       from todo_list
        left join users on users.chat_code = todo_list.chat_code
        where todo_list.creator_id = $creator_id and todo_list.has_done = 0
        ");
        return $query->fetchAll();

    }
    public function archive($creator_id){
        $query = $this->db->query("
        SELECT todo_list.* , users.id as user_id , users.chat_code as chat_code , users.firstName as firstName , users.lastName as lastName
from todo_list
LEFT JOIN users on users.id = todo_list.customer_id
where todo_list.creator_id = $creator_id and todo_list.has_done = 1
");
        return $query->fetchAll();
    }
    public function store($data,$due_date){

        try {
            $creator_id = $data['creator_id'];
            $message = $data['message'];
            $chat_code = !empty($data['chat_code']) ?$data['chat_code'] : 'NULL';

            $this->db->query("insert into todo_list (creator_id,message,chat_code,due_date)
            values ($creator_id,'$message',$chat_code,'$due_date')
        ");
        }catch (\PDOException $e){
            die($e->getMessage());
        }
    }
    public function update($data,$due_date,$id){
        $creator_id = $data['creator_id'];
        $message = $data['message'];
        $chat_code = $data['chat_code'];
        $has_done = $data['has_done'];

        $this->db->query("update  todo_list set creator_id= $creator_id, message = '$message', chat_code = $chat_code,has_done =  $has_done, due_date = '$due_date'
         where id=$id");
    }
    public function delete($id){
        $this->db->query("delete from todo_list where id =$id");
    }
    public function done($id){
        $this->db->query("update todo_list set has_done = 1 where id = $id");
    }
    public function read_to_show($admin_id,$now){
        try {
            $query = $this->db->query("
            SELECT todo_list.* , users.firstName , users.lastName , users.id as user_id
FROM todo_list
LEFT JOIN users on users.chat_code = todo_list.chat_code
            WHERE due_date <= '$now'
            AND has_done = 0
            AND creator_id = $admin_id
            order by todo_list.id
            limit 1
            ");
            return $query->fetch();
        } catch (\PDOException $e){
            $e->getMessage();
        }
    }
    public function today_todo($admin_id , $today){
        try {
            $query = $this->db->query("
            SELECT todo_list.* , users.firstName , users.lastName , users.id as user_id
FROM todo_list
LEFT JOIN users on users.chat_code = todo_list.chat_code
            WHERE due_date like '%$today%'
            AND has_done = 0
            AND creator_id = $admin_id
            order by todo_list.id
            ");
            return $query->fetchAll();
        } catch (\PDOException $e){
            $e->getMessage();
        }
    }
}