<?php
require_once dirname(__DIR__, 3)."/config.php";
class users
{
    public $fillable = ["id", "chat_code", "consultant_id", "checked", "details", "roll", "firstName", "lastName", "gender", "mobile", "mobile_2", "email", "password", "forgot_pass_identity", "pic", "online", "status", "jobs", "bio", "amount", "province_id", "city_id", "fullAddress", "token", "link", "comment"];
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
    public function my_customers($admin_id,$offset , $limit = 5){
        
        try {

            $query = $this->db->query("
            SELECT *
            from users
            WHERE consultant_id =  $admin_id
            order by id desc
            limit $limit
            offset $offset
            ");
            return $query->fetchAll();
        } catch (\Exception $e){
            return $e->getMessage();
        }
    }
    public function login($mobile)
    {
        $result = $this->db->query("select * from users where mobile = $mobile");
        return $result->fetch();

    }
    public function register($data){
        try {
            $this->db->query("INSERT INTO users(chat_code,mobile,password) VALUES('$data->code','$data->mobile','$data->password')");
            return $this->db->lastInsertId();
        } catch (PDOException $e){
            return  $e->getMessage();
        }
    }
    public function modify($data){

        foreach ((object)$data as $key=>$value){
            $data = (object)$data;
//            var_dump($data);
//            die();
            if (in_array($key,$this->fillable)){
                $sql = "UPDATE users SET $key = '$value' WHERE id = $data->id";
//                var_dump($sql);
//                die();
                $this->db->query($sql);
            }
        }
    }


    public function loginByCode($code)
    {
        try {
            $query = $this->db->query("SELECT * FROM users where chat_code = '$code'");
            return $query->fetch();
        }
        catch (\PDOException $e){
            return false;
        }
    }
    public function adminLogin($email){
        $result = $this->db->query("select * from users where email='$email'");
        return $result->fetch();
    }
    public function set_token(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
    public function update($data,$path)
    {
        $id = $data["id"];
        $firtName = $data["firstName"];
        $lastName = $data["lastName"];
        $mobile = $data["mobile"];
        $email = $data["email"];
        $bio = $data["bio"];
        $province_id = $data["bio"];
        $city_id = $data["bio"];
        $fullAddress = $data["bio"];


        $this->db->query("update users set firstName='$firtName',lastName='$lastName',mobile='$mobile',email='$email',bio='$bio',pic='$path',province_id='$province_id',city_id='$city_id',fullAddress='$fullAddress' where id='$id'");
    }
    public function changePass($pass,$user_id){
        $this->db->query("update users set password='$pass' , forgot_pass_identity = null  where id=$user_id");
    }
    public function find($id){

        $query = $this->db->query("select * from users where id=$id");
        return $query->fetch();
    }
    public function get_user_name($id): string
    {
        $query = $this->db->query("select * from users where id=$id");
        $user = $query->fetch();
        return $user['lastName'];
    }
    public function findByMobile($mobile){
        $query = $this->db->query("select * from users where mobile='$mobile' limit 1");
        return $query->fetch();
    }
    public function findByPasswordToken($token){
        $query = $this->db->query("select * from users where forgot_pass_identity='$token' limit 1");
        return $query->fetch();
    }
    public function findByEmail($email){
        $query = $this->db->query("select * from users where email='$email' limit 1");
        return $query->fetch();
    }
    public function findByCode($code){
        $query = $this->db->query("select * from users where chat_code='$code' limit 1");
        return $query->fetch();
    }
    public function userID($email){
        $query = $this->db->query("select id from users where email='$email'");
        $result = $query->fetch();
        return $result;
    }
    public function edit($id){
        $query = $this->db->query("select * from users where id='$id'");
        $result = $query->fetch();
        return $result;
    }
    public function store($data,$pic){
        $firstName = (isset($data["firstName"]))?$data["firstName"]:'';
        $lastName = (isset($data["lastName"]))?$data["lastName"]:'';
        $lastName = (isset($data["lastName"]))?$data["lastName"]:'';
        $mobile = (isset($data["mobile"]))?$data["mobile"]:'';
        $email = (isset($data["email"]))?$data["email"]:'';
        $roll_id = (isset($data["roll_id"]))?$data["roll_id"]:'';
        $password = sha1($data["password"]);
        $bio = (isset($data["bio"]))?$data["bio"]:'';
        $province_id = (isset($data["province_id"]))?$data["province_id"]:'';
        $city_id = (isset($data["cities"]))?$data["cities"]:'';
        $fullAddress = (isset($data["bio"]))?$data["bio"]:'';

        $this->db->query("
            insert into users(roll,firstName,lastName,mobile,email,password,pic,bio,province_id,city_id,fullAddress)
            values ('$roll_id','$firstName','$lastName','$mobile','$email','$password','$pic','$bio','$province_id','$city_id','$fullAddress')");


    }
    public function storeUser($data,$pic){
        $roll = 8;
        if (isset($data->roll)){
            $roll = $data->roll;
        }
        try {
            $this->db->query("
            insert into users(chat_code,consultant_id,roll,firstName,lastName,gender,mobile,mobile_2,pic,province_id,city_id,link,comment)
            values (
                    '$data->chat_code',
                    '$data->consultant_id',
                    '$roll',
                    '$data->firstName',
                    '$data->lastName',
                    '$data->gender',
                    '$data->mobile',
                    '$data->mobile_2',
                    '$pic',
                    '$data->province_id',
                    '$data->city_id',
                    '$data->link',
                    '$data->comment'
            )");
            $this->db->query("INSERT INTO chats(code,message,user_type,owner_id)
            values (
                    '$data->chat_code',
                    ' ',
                    'user',
                    '$data->consultant_id'
            )");
            return $this->db->lastInsertId();
        }
        catch (PDOException $e){
            return false;
        }


    }
    public function userDelete($id){
        $this->db->query("delete from users where id = $id");
        $this->db->query("delete from user_admin where customer_id = $id");
    }
    public function userUpdate($data,$pic){
        $query = "update users set ";
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
//        var_dump($parts);die();
        $final_query = $query . implode(',',$parts). " ,pic='$pic' where id = $data->id";
        $this->db->query($final_query);

    }
    public function make_query($data){

    }
    public function adminlist(){
        $query = $this->db->query("select * from users where roll in (1,2,3,4,5,6,10) order by id desc");
        $result = $query->fetchAll();
        return $result;

    }
    public function users_list(){
        $result = $this->db->query("select * from users where roll !='admin'");
        $row=$result->fetchAll();
        return $row;
    }
    public function findRoll($id){
        $query = $this->db->query("select * from rolls where id='$id'");
        $result = $query->fetch();
        return $result;
    }
    public function chat_list($id){
        date_default_timezone_set('Asia/Tehran');
        $chat = $this->db->query("select * from chat_files where owner=$id");
        $result = $chat->fetchAll();
//        foreach ($result as $res){
//            $user_id = $res['user_id'];
//            $query = $this->db->query("select * from users where id=$user_id");
//            $user = $query->fetch();
//            $res['user_name'] = 'test';
////            $user_name = $user['firstName'] . ' ' . $user['lastName'];
////            array_push($result,array('user_name'=>$user_name));
//        }

//        $result = array(
//            "dog" => "cat"
//        );

//        $user = $this->find();
//        return $result->fetchAll();
        return $result;

    }
    public function roll(){
        $query = $this->db->query("select * from rolls");
        $result = $query->fetchAll();
        return $result;
    }
    public function rollUpdate($roll_id,$id){
        $this->db->query("update users set roll ='$roll_id' where id='$id'");
    }
    // Quick Find Functions
    public function find_chat_file($file_name){
        $query = $this->db->query("select  * from chat_files where file_name = '$file_name'");
        return $query->fetch();
    }
    public function admin_customers($admin_id){
        $query = $this->db->query("select * from customer_admin where admin_id=$admin_id order by id desc");
        return $query->fetchAll();
    }
    public function provinces(){
        $query = $this->db->query("select * from provinces");
        $result = $query->fetchAll();
        return $result;
    }
    public function cities($province_id){
        $query = $this->db->query("select * from cities where province_id='$province_id'");
        $result = $query->fetchAll();
        return $result;
    }
    public function findCity($cityID){
        $query = $this->db->query("select * from cities where id=$cityID");
        return $query->fetchAll();
    }
    public function userLastTask($user_id){
        $query = $this->db->query("select file_name from chat_files where user_id='$user_id' order by id desc limit 1");
        $result = $query->fetchAll();
        return $result;
    }
    public function userChatFiles($user_id){
        $query = $this->db->query("select * from chat_files where user_id='$user_id' order by id desc");
        $result = $query->fetchAll();
        return $result;
    }
    public function customers(){
        $result = $this->db->query("select * from users where roll=8 order by id desc");
        $row=$result->fetchAll();
        return $row;
    }
    public function dr_list(){
        $result = $this->db->query("select * from users where roll=3");
        $row=$result->fetchAll();
        return $row;
    }
    public function status($id,$status){
        $this->db->query("update users set status='$status' where id = $id");
        $query = $this->db->query("select roll from users where id = $id");
        $user_roll = $query->fetch();
        if ($status == NULL){
            if ($user_roll["roll"] == 8){
                setcookie("TF-Mobile", "", time() - 3600);
            } else {
                setcookie("TF-Email", "", time() - 3600);
            }
            header('location:login.php');
        }

    }
    public function totalPayments($user_id){
        $query = $this->db->query("select price from payments where customer_id=$user_id");
        $payments = $query->fetchAll();
        $totalPayment = 0;
        foreach ($payments as $payment) {
            $totalPayment += $payment['price'];

        }
        return $totalPayment;
    }
    public function getPayments($user_id){
        $query = $this->db->query("select * from payments where customer_id=$user_id and accepted_by != 0 limit 3");
        return $query->fetchAll();
    }
    public function getTasks($user_id){
        $query = $this->db->query("select * from tasks where customer_id=$user_id");
        return $query->fetchAll();
    }
    public function get_invoices($custome_id){
        $query = $this->db->query("select * from invoices where customer_id=$custome_id");
        return $query->fetchAll();
    }
//    public function unpaidPercent($user_id){
//        $query = $this->db->query("select * from invoices where customer_id=$user_id");
//        $amount = $query->fetchAll();
//        $totalInvoice = 0;
//        foreach ($amount as $am){
//            $totalInvoice += $am['price'];
//        }
//
//        $query = $this->db->query("select * from payments where customer_id=$user_id");
//        $pays = $query->fetchAll();
//        $totalPay = 0;
//        foreach ($pays as $pay){
//            $totalPay += $pay['price'];
//        }
//        if (!$totalInvoice === 0){
//            $sum = ceil(($totalInvoice - $totalPay )/$totalInvoice * 100) ;
//
//        } else {
//            $sum = 0;
//
//        }
//        return $sum;
//    }
    public function checkPaymentPercent($task_id){
        $query = $this->db->query("select price from invoices where task_id=$task_id");
        $totalAmount = $query->fetch();
        $query = $this->db->query("select price from payments where task_id=$task_id");
        $payments = $query->fetchAll();

        $totalPay = 0;
        foreach ($payments as $payment){
            $totalPay += $payment['price'];
        }
        $sum = 0;
        if ($totalAmount !== 0){
            $sum = ceil(($totalAmount["price"] - $totalPay )/$totalAmount["price"] * 100) ;
        }

        return $sum;


    }
    public function paymentsForTask($task_id){
        $totalPay = 0;
        $query = $this->db->query("select * from payments where task_id=$task_id");
        $payments = $query->fetchAll();
        foreach ($payments as $payment){
            $totalPay += $payment['price'];
        }
        $query = $this->db->query("select * from invoices where task_id=$task_id");
        $amount = $query->fetch();

        $sum = $amount['price'] - $totalPay;
        return $sum;

    }
    public function taskPayments($task_id){
        $query = $this->db->query("select * from payments where task_id=$task_id");
        return $query->fetchAll();
    }

    public function doneTasks($user_id){
        $query = $this->db->query("select * from tasks where customer_id=$user_id order by id desc");
        return $query->fetchAll();
    }
    public function tasksList($user_id){
        $query = $this->db->query("select * from tasks where customer_id=$user_id order by id desc");
        return $query->fetchAll();
    }
    public function consultant_list(){
        $query = $this->db->query("select * from users where roll=5");
        return $query->fetchAll();
    }
    public function supporter_list(){
        $query = $this->db->query("select * from users where roll=4 order by jobs");
        return $query->fetchAll();
    }
    public function supporterChats($user_id){
        $query = $this->db->query("select * from chat_files where supporter_id=$user_id");
        return $query->fetchAll();
    }
    public function user_admin_pivot($userID,$adminID){
        $this->db->query("insert into user_admin name(customer_id,admin_id) values ($userID,$adminID)");
    }

    // User Finance Functions
    public function createInvoice($data,$due_date_time){
        $creator_id = $data['creator_id'];
        $customer_id = $data['customer_id'];
        $min_percent = $data['min_percent'];
        $text = $data['text'];
        $unique_id = rand();
        $price = $data['price'];
        $status = 0;

        $this->db->query("insert into invoices(creator_id,customer_id,unique_id,price,min_percent,status,due_date_time) values ($creator_id,$customer_id,$unique_id,$price,$min_percent,'$status','$due_date_time')");
        $this->db->query("insert into comments(customer_id,admin_id,invoice_unique_id,text) values ($customer_id,$creator_id,$unique_id,'$text')");
        return $unique_id;
    }

    public function invoicesList($creator_id){
        $query = $this->db->query("select * from invoices where creator_id=$creator_id");
        return $query->fetchAll();
    }
    public function allInvoices(){
        $query = $this->db->query("select * from invoices");
        return $query->fetchAll();
    }
    public function deleteInvoice($id){
        $this->db->query("delete from invoices where id=$id");
    }
    public function get_invoice($invoice_id){
        $query = $this->db->query("select * from invoices where unique_id=$invoice_id");
        return $query->fetch();
    }
    public function users_payments(){
        $query = $this->db->query("select * from payments order by id desc");
        return $query->fetchAll();
    }
    public function check_payment($invoice_unique_id){
        $query = $this->db->query("select * from payments where invoice_unqiueID=$invoice_unique_id");
        return $query->fetchAll();
    }
    public function invoices_list(){
        $query = $this->db->query("select * from invoices order by id desc");
        return $query->fetchAll();
    }
    public function left_payment($invoice_id){
        $total_payments = 0;
        $query = $this->db->query("select * from payments where invoice_unqiueID=$invoice_id");
        $total = $query->fetchAll();
        if ($total){
            foreach ($total as $pay) {
                $total_payments += $pay['price'];
            }
        }
        return $total_payments;
    }
    public function find_by_code($code){
        $query = $this->db->query("SELECT * FROM users where chat_code = '$code'");
        return $query->fetch();
    }
    // User Message System
    public function getComments($invoice_id){
        $query = $this->db->query("select * from comments where invoice_unique_id=$invoice_id");
        if ($query){
            return $query->fetchAll();

        } else {
            return false;
        }
    }
    public function supporterComment($taskid){
        $query = $this->db->query("select creator_comment from tasks where id=$taskid");
        if ($query){
            return $query->fetch();

        } else {
            return false;
        }
    }

    // Dr Task Functions
    public function create_task($creator,$data,$invoice_unqiueID,$due_date_time){
        $task_id = rand();
        $title = $data["service_id"];
        $dr_id = $data["dr_id"];
        $customer_id = $data["customer_id"];

        $echo = $this->db->query("insert into tasks(`creator", "task_id", "invoice_unqiueID", "title", "dr_id", "customer_id", "due_date_time`) values ('$creator','$task_id','$invoice_unqiueID','$title','$dr_id','$customer_id','$due_date_time')");
    }

    public function get_service($id){
        $query = $this->db->query("select title from services where id = $id");
        return $query->fetch();
    }

    public function update_task($invoice_unqiueID){
        $this->db->query("update tasks set pay_status = 1 where invoice_unqiueID = $invoice_unqiueID");
    }
    public function get_diseases(){
        $query = $this->db->query("select * from diseases order by id desc");
        return $query->fetchAll();
    }
    public function user_efile_create($data,$user_birthday,$user_last_childbirth){
        $user_id = $data["user_id"];
        $user_gendre = $data['user_gendre'];
        $user_pregnant_number = $data['user_pregnant_number'];
        $user_childbirth_number = $data['user_childbirth_number'];
        $user_weight = $data['user_weight'];
        $user_height = $data['user_height'];
        $user_national_code = $data['user_national_code'];
        $user_father_name = $data['user_father_name'];
        $user_job = $data['user_job'];
        $user_home_phone = $data['user_home_phone'];
        $user_has_married = $data['user_has_married'];
        $province_id = $data['province_id'];
        $cities = $data['cities'];
        $user_full_address = $data['user_full_address'];
        $user_instagram_id = $data['user_instagram_id'];
        $user_diseases = $data['user_diseases'];
        $user_other_diseases = $data['user_other_diseases'];
        $user_has_drug = $data['user_has_drug'];
        $user_has_surgery = $data['user_has_surgery'];
        $user_has_family_surgery = $data['user_has_family_surgery'];
        $user_diseases_str = implode(',', $user_diseases);
        $query = $this->db->query("select id from user_efile order by id desc limit 1");
        $last_row = $query->fetch();
        $new_row = $last_row["id"] + 1;
        $this->db->query("INSERT INTO `user_efile`(`user_id", "birthday", "gendre", "pregnant_number", "childbirth_number", "last_childbirth", "weight", "height", "national_code", "father_name", "job", "home_phone", "has_married", "province_id", "city_id", "full_address", "instagram_id", "diseases", "other_diseases", "has_drug", "has_surgery", "has_family_surgery`) VALUES ($user_id,'$user_birthday','$user_gendre','$user_pregnant_number','$user_childbirth_number','$user_last_childbirth',$user_weight,$user_height,'$user_national_code','$user_father_name','$user_job','$user_home_phone','$user_has_married',$province_id,$cities,'$user_full_address','$user_instagram_id','$user_diseases_str','$user_other_diseases','$user_has_drug','$user_has_surgery','$user_has_family_surgery')");

        $this->db->query("update users set details=$new_row where id = '$user_id'");
    }
    public function get_user_details($id){
        $query = $this->db->query("
        select *
        from users 
        inner join user_efile
           on users.id=user_efile.user_id 
           where users.id = $id"
        );
        return $query->fetch();
    }
    public function get_province_name($id){
        $query = $this->db->query("select name from provinces where id = $id");
        return $query->fetch();
    }
    public function get_city_name($id){
        $query = $this->db->query("select name from cities where id = $id");
        return $query->fetch();
    }
    public function find_diseases($id){
        $query = $this->db->query("select * from diseases where id =$id");
        return $query->fetch();
    }
    public function signup($data){
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $mobile = $data['mobile'];
        $password = sha1($data['password']);
        $query = $this->db->query("insert into users(roll,firstName,lastName,mobile,password)
        values ('8','$firstName','$lastName','$mobile','$password')");
        return true;
    }
    public function all_customers(): array
    {
        $query =$this->db->query("
        SELECT users.* , admins.nick_name as admin_nick_name , admins.first_name as admin_frist_name , admins.last_name as admin_last_name , admins.id as admin_id , rolls.title as roll_title , rolls.fa_title as roll_fa_title , rolls.id as roll_id
        from users
        left JOIN admins on admins.id = users.consultant_id
        LEFT JOIN rolls on rolls.id = admins.roll_id
        ORDER BY users.id desc");
        return $query->fetchAll();
    }
//    public function my_customers($id): array
//    {
//        $query = $this->db->query("
//        SELECT users.*, admins.nick_name as admin_nick_name , admins.first_name as admin_frist_name , admins.last_name as admin_last_name , admins.id as admin_id , rolls.title as roll_title , rolls.fa_title as roll_fa_title , rolls.id as roll_id
//        from users
//        left JOIN admins on admins.id = users.consultant_id
//        LEFT JOIN rolls on rolls.id = admins.roll_id
//        where admins.id = $id
//        ORDER BY users.id desc
//        ");
//        return $query->fetchAll();
//    }
    public function my_customers_new($id): array
    {
        try {
            $query = $this->db->query("
       SELECT users.* , admins.nick_name , admins.id as admin_id , rolls.title , rolls.id as roll_id
        from users
        LEFT JOIN admins on admins.id = users.consultant_id
        LEFT JOIN rolls on rolls.id = admins.roll_id
          where users.consultant_id = $id 
        ORDER BY users.id DESC
        ");
            return $query->fetchAll();
        }catch (PDOException $e){
            die($e->getMessage());
        }
    }
    public function get_city($id)
    {
        $query = $this->db->query("select * from cities where province_id = $id");
        return $query->fetchAll();
    }
    public function checkMobile($mobile)
    {
        $query = $this->db->query("SELECT * FROM users where mobile = '$mobile'");
        return $query->fetch();
    }
    public function user_info($link){
        $query = $this->db->query("
        SELECT user_admin.* , user_admin.id as pivot_id , users.*
        from user_admin
        left JOIN users on users.id = user_admin.customer_id
        where users.link = '$link'
        ");
        return $query->fetch();
    }
    public function get_consultant($id){

    }

    // Guest Functions
    public function check_link($link): bool
    {
        try {
            $query = $this->db->query("SELECT * FROM users where chat_code = '$link'");
            $result = $query->fetch();
            if ($result){
                return true;
            } else {
                return false;
            }
        }
        catch (\PDOException $e)
        {
            return false;
        }
    }
    public function accept_user($id)
    {
        $this->db->query("UPDATE users set checked = 1 where id = $id");
    }

    public function site_admin_customers1(){
        try {
            $query = $this->db->query("
            SELECT *
            FROM `chats` WHERE `user_id` = 0 AND `created_at` >= CURDATE()
            GROUP BY code
            ");
            return  $query->fetchAll();
        } catch (PDOException $e){
            return $e->getMessage();
        }
    }
    public function site_admin_customers2(){
        try {
            $query = $this->db->query("
            SELECT *
            FROM `users` WHERE `consultant_id` is null
            GROUP BY chat_code
            ");
            return  $query->fetchAll();
        } catch (PDOException $e){
            return $e->getMessage();
        }
    }

}