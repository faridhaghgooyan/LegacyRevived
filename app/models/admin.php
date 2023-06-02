<?php
class admin {
    protected $tbl = 'admins';
    public function __construct() {
        global $db;
        $this->db=$db;
    }
    public function login($email)
    {
        try {
            $query = $this->db->query("SELECT admins.* , rolls.id as roll_id , rolls.title as roll_title , rolls.fa_title as roll_fa_title
                FROM admins
                left join rolls on rolls.id = admins.roll_id
                WHERE admins.email = '$email' limit 1");
            return $query->fetch();
        }
        catch (\PDOException $e)
        {
            return  $e->getMessage();
        }
    }
    public function find($id)
    {
        try {
            $query = $this->db->query("SELECT * FROM admins
                WHERE id = '$id' ");
            return $query->fetch();
        }
        catch (\PDOException $e)
        {
            return  $e->getMessage();
        }
    }
    public function create($data)
    {
        try {
            $this->db->query("INSERT INTO $this->tbl(
                  roll_id,first_name,last_name,nick_name,mobile,phone,email,password,address,profile)
            values (
                   '$data->roll_id', 
                   '$data->first_name', 
                   '$data->last_name', 
                   '$data->nick_name', 
                   '$data->mobile', 
                   '$data->phone', 
                   '$data->email', 
                   '$data->password', 
                   '$data->address', 
                   '$data->profile'
            )");
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function update($data,$pic){
        $query = "update admins set ";
        $var = get_object_vars($data);
        $parts = [];
        foreach ($var as $key=>$value){
            if (strlen($value) != 0){
                if ($key == 'password'){
                    $value = sha1($value);
                }
                $parts[] = $key.'='."'".$value."'";
            }
        }
        $final_query = $query . implode(',',$parts). " ,profile='$pic' where id = $data->id";
        $this->db->query($final_query);
    }
    public function delete($id){
        $this->db->query("delete from admins where id = $id");
        $this->db->query("delete from user_admin where admin_id = $id");
    }
    public function list(): array
    {
        try {
            $query = $this->db->query("SELECT admins.* , rolls.title as roll_title , rolls.fa_title as roll_fa_title
                FROM admins
                left join rolls on rolls.id = admins.roll_id
                WHERE admins.deleted_at is null and admins.roll_id != 1 order by admins.id desc");
            return $query->fetchAll();
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function my_admins()
    {
        try {
            $query = $this->db->query("SELECT * FROM admins
                WHERE roll_id != 1 order by id desc limit 5 ");
            return $query->fetchAll();
        }
        catch (\PDOException $e)
        {
            return  $e->getMessage();
        }
    }
    public function admins($roll_title)
    {
        try {
            $query = $this->db->query("SELECT admins.* , rolls.id as roll_id ,
                    rolls.title as roll_title , rolls.fa_title as roll_fa_title
                from admins
                left join rolls on rolls.id = admins.roll_id
                where rolls.title = '$roll_title'");
            return $query->fetchAll();
        }
        catch (\PDOException $e)
        {
            return  $e->getMessage();
        }
    }
    public function my_customers()
    {
        try {
            $query = $this->db->query("SELECT * FROM users
                order by id desc limit 5 ");
            return $query->fetchAll();
        }
        catch (\PDOException $e)
        {
            return  $e->getMessage();
        }
    }
    public function jobs($admin_id): array
    {
        try {
            $query = $this->db->query("
            SELECT todo_list.* , users.* from todo_list
            left join users on users.id = todo_list.customer_id
            where todo_list.creator_id = $admin_id and todo_list.has_done = 0
");
            return $query->fetchAll();
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    public function check_number($data): array
    {
        try {
            $query = $this->db->query("SELECT * FROM admins WHERE mobile = '$data' or phone = '$data'");
            return $query->fetchAll();
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    public function adminUsers($email) {

        $result=$this->db->query("select * from admin where email='$email'");
        $row=$result->fetch();
        return $row;
    }
    public function assign_admin($user_id,$admin_id): bool
    {

        try {
            $this->db->query("insert into user_admin(customer_id,admin_id) values($user_id,$admin_id)");
            return true;
        }
        catch (\PDOException $e){
            return false;
        }
    }
    public function reviewed($user_id): bool
    {

        try {
            $this->db->query("update user_pivot set has_checked = 1 where user_id = $user_id");
            return true;
        }
        catch (\PDOException $e){
            return false;
        }
    }
    public function rolls_list() : array
    {
        try {
            $query = $this->db->query("SELECT * FROM rolls order by id desc");
            return $query->fetchAll();
        }
        catch (PDOException $e)
        {
            echo  $e->getMessage();
        }
    }
}