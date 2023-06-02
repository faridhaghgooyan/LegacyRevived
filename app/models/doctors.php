<?php
namespace app\models;
if (file_exists('../config.php')){
    require_once '../config.php';
} else {
    require_once '../../config.php';
}
class doctors {
    public function __construct() {
        global $db;
        $this->db=$db;
    }
    public function tasks_list($dr_id){
        $query = $this->db->query("select * from tasks where operator_id = $dr_id and has_done = 0 ");

        return $query->fetchAll();
    }
    public function old_tasks($dr_id){
        $query = $this->db->query("select * from tasks where operator_id = $dr_id and has_done = 1 order by id desc");
        return $query->fetchAll();
    }
    public function addComment($comment,$task_id){
        $this->db->query("update tasks set drComment='$comment' where task_id='$task_id'");
    }


    public function dr_list(){
        $result=$this->db->query("select * from doctors ORDER BY id DESC");
        $row=$result->fetchAll();
        return $row;
    }
    public function dr_edit($id){
        $result=$this->db->query("select * from doctors where id='$id'");
        $row=$result->fetch();
        return $row;
    }
    public function dr_store($data,$path){
        $firtName = $data["firstName"];
        $lastName = $data["lastName"];
        $mobile = $data["mobile"];
        $email = $data["email"];
        $bio = $data["bio"];
        $this->db->query("insert into doctors(firstName,lastName,mobile,email,bio,pic) values('$firtName','$lastName','$mobile','$email','$bio','$path') ");
    }
    public function dr_update($data,$path){
        $id = $data["id"];
        $firtName = $data["firstName"];
        $lastName = $data["lastName"];
        $mobile = $data["mobile"];
        $email = $data["email"];
        $bio = $data["bio"];
        $this->db->query("update doctors set firstName='$firtName',lastName='$lastName',mobile='$mobile',email='$email',bio='$bio',pic='$path' where id='$id'");
    }
    public function dr_destroy($id){
        $this->db->query("delete from doctors where id='$id'");

    }
    public function find($id){
        $query = $this->db->query("select * from doctors where id=$id");
        $result = $query->fetch();
        return $result;
    }
}