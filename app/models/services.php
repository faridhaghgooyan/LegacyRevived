<?php
namespace app\models;
if (file_exists('../config.php')){
    require_once '../config.php';
} else {
    require_once '../../config.php';
}

class services {
    public $fillable = ["id", "customer_id", "admin_id", "service_id", "status", "message", "created_at", "deleted_at"];
    public function __construct(){
        global $db;
        global $table;
        $this->db = $db;
        $table = 'ticket';
    }
    public function list(){
        $query = $this->db->query("select * from services order by id desc ");
        return $query->fetchALL();
    }
    public function modify($data){

        foreach ((object)$data as $key=>$value){
            $data = (object)$data;
            if (in_array($key,$this->fillable)){
                $sql = "UPDATE service_req SET $key = $value WHERE id = $data->id";
                $this->db->query($sql);
            }
        }
    }

    public function findReq($id){
        $query = $this->db->query("select service_req.* , services.title 
from service_req 
LEFT JOIN services on services.id = service_req.service_id
where service_req.id = $id order by service_req.id desc");
        return $query->fetch();
    }
    public function find($id){
        $query = $this->db->query("select * from services where id=$id");
        return $query->fetch();
    }
    public function create($data,$pic) {

        $title = $data["title"];
        $price = $data["price"];
        $disPrice = 0;
        if ($data["disPrice"]){
            $disPrice = $data["disPrice"];

        }
        $desc = $data["description"];

        $this->db->query("insert into services(title,price,description,dis_price,pic) values ('$title','$price','$desc','$disPrice','$pic')");

    }
    public function read($id){
        $query = $this->db->query("select * from services where id=$id");
        return $query->fetch();
    }
    public function update($data,$pic,$id) {
        $title = $data["title"];
        $price = $data["price"];
        $disPrice = $data["disPrice"];
        $desc = $data["description"];
        $this->db->query("update services set
                    title = '$title',
                    price = '$price',
                    description = '$desc',
                    dis_price = '$disPrice',
                    pic = '$pic' 
                    where id=$id");
    }
    public function delete($id){
        $this->db->query("delete from services where id=$id");
    }
    public function customer_req($data){

        $customer_id = $data['customer_id'];
        $service_id = $data['service_id'];
        $message = $data['message'];

        $this->db->query("insert into service_req(customer_id,service_id,message) values ('$customer_id','$service_id','$message')");

    }
    public function admin_service_req_list(){
        $query = $this->db->query("select * from service_req where status=1");
        return $query->fetchAll();
    }
    public function done_service_req($id){
        $this->db->query("update service_req set status = 2 where id = $id");
    }
    public function get_user_req($id){
        $query = $this->db->query("select service_req.* , services.title 
from service_req 
LEFT JOIN services on services.id = service_req.service_id
where service_req.customer_id = $id order by service_req.id desc");
        return $query->fetchAll();
    }
    public function findService($id){
        $query = $this->db->query("select * from services where id = $id");
        return $query->fetch();
    }

    public function index(){
        try {
            $query = $this->db->query("
        SELECT service_req.* , service_req.id as req_id , services.* , users.*
        from service_req
        LEFT JOIN services on service_req.service_id = services.id
        LEFT JOIN users on service_req.customer_id = users.id
        WHERE service_req.status = 1
        order by service_req.id desc 
        ");
            return $query->fetchAll();
        } catch (\Exception $e){
            return  $e->getMessage();
        }
    }

}