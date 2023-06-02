<?php
namespace app\models;
if (file_exists('../config.php')){
    require_once '../config.php';

} else {
    require_once '../../config.php';

}
class drafts{
    protected $tbl = 'drafts';
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function create($text){
        $this->db->query("insert into $this->tbl(text) values ('$text')");
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
    public function list(){
        $query = $this->db->query("select * from  $this->tbl order by id desc");
        return $query->fetchAll();
    }

}