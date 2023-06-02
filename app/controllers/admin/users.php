<?php
use app\models\doctors;
use app\models\uploader;
use app\models\dateConverter;
use app\models\finance;
use app\models\chat;
use app\models\notes;
require_once '../app/models/admin.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/uploader.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/finance.php';
require_once '../app/models/chat.php';
require_once '../app/models/permissions.php';
require_once '../app/models/notes.php';
$admin_obj = new admin();
$user_obj = new users();
$dr_obj = new doctors();
$uploader = new uploader();
$permission_obj = new permissions();
$finance_obj = new finance();
$chat_obj = new chat();
$dateConvertor_obj = new dateConverter();
$note_obj = new notes();

switch ($action){
    case 'login':
        $email = $_POST['email'];
        $pass = strtolower(sha1($_POST['password']));
        $user = $user_obj->adminLogin($email,$pass);
        if ($user['email'] == $email && $user['password'] == $pass){

            if ($user['status'] === "active"){
                setcookie("TF-Email", $email, time()+(86400 * 30));

                $status = 1;
                $user_id = $user_obj->findByEmail($user['email'])["id"];

                header('location:?c=index&a=index');
            } else {
                echo '<script>alert("حساب کاربر شما مسدود میباشد!")</script>';
                header('location:/admin/login.php');
            }


        } else {
            echo '<script>alert("نام کاربری یا رمز عبور میباشد!")</script>';
            header('location:/admin/login.php');
        }
        break;
    case 'add':
        $provinces = $user_obj->provinces();
        $rolls = $user_obj->roll();
        break;
    case 'galleries':
        $user = (object)$user_obj->find($_GET['id']);

        if($user){
            $galleries = $chat_obj->get_by_type($user->id,'image');
        }
        break;
    case 'addUser':

        $rolls = $admin_obj->rolls_list();
        if ($admin_info->roll_id != 5){
            $consultants = $admin_obj->admins('consultant');
        }

        $provinces = $user_obj->provinces();

    break;
    case 'store':
        $data = $_POST;

        $pic = '/storage/noimage.jpg';
        if ($_FILES["profilepic"]["size"] > 0){
            $pic = $uploader->fileUpload($_FILES["profilepic"], 'profile');
        }
        $user_obj->store($data,$pic);
        break;
    case 'storeUser':

        $chat_code = $_POST['chat_code'];
        $note = $_POST['comment'];
        $_POST['created_at'] = date('Y-m-d H:i:s');
        $_POST['date'] = $dateConvertor_obj->date_convert(date('Y-m-d H:i:s'),'jalali')[0]['date'];
        $_POST['time'] = $dateConvertor_obj->date_convert(date('Y-m-d H:i:s'),'jalali')[0]['time'];

        $note_obj->create($chat_code,$note,$_POST['time'],$_POST['date']);
        if ($admin_info->roll_title == 'consultant'){
            $_POST['consultant_id'] = $admin_info->id;
        }

        $pic = '/storage/noimage.jpg';
        if (isset($_FILES["profilepic"]) and $_FILES["profilepic"]["size"] > 0){
            $pic = $uploader->fileUpload($_FILES["profilepic"], 'profile');
        }

        $last_row = $user_obj->storeUser((object)$_POST,$pic);

        if ($last_row){
            $admin_obj->assign_admin($last_row,$_POST['consultant_id']);
            header('location:?c=users&a=list');
        }
        break;
    case 'read' :
        $provinces = $user_obj->provinces();
        $rolls = $user_obj->roll();
        $userID = (int)$_GET['id'];

        $userInfo = $user_obj->find($_GET['id']);
        $cities = $user_obj->cities($userInfo['province_id']);

        $consultants = $admin_obj->admins('consultant');
        break;
    case 'list':
        if (in_array($admin_info->roll_title,array('admin','site_admin'))){
            $customers = $user_obj->all_customers();
        } else {

            $customers = $user_obj->my_customers_new($admin_info->id);


        }
        break;
    case 'adminlist':

        $adminusers = $user_obj->adminlist();
        $user_obj = new users();
        $rolls = $user_obj->roll();
        break;
    case 'admins':

        $adminusers = $user_obj->adminlist();
        $user_obj = new users();
        $rolls = $user_obj->roll();
        break;
    case 'status' :
        $status = $_POST ["status"];
        $user_id = $_POST ["user_id"];
        $user_obj->status($user_id,$status);
        break;
    case 'rollUpdate' :
        $user_id = $_POST['user_id'];
        $roll_id = $_POST['roll_id'];
        $user_obj->rollUpdate($roll_id,$user_id);

        break;
    case 'edit':
        $id = $_GET['id'];
        $user = $user_obj->edit($id);
        break;
    case 'update':
        $path = $uploader->upload($_FILES['profilepic']);
        $data = $_POST['data'];
        $user = $user_obj->update($data,$path);
        break;
    case 'show':
        break;
    case 'userUpdate':
        $pic = '/storage/noimage.jpg';
        if (isset($_FILES["profilepic"]) and $_FILES["profilepic"]["size"] > 0){
            $pic = $uploader->fileUpload($_FILES["profilepic"], 'profile');
        }
        $user_obj->userUpdate((object)$_POST,$pic);
        header('location:?c=users&a=list');
        break;
    case 'userDelete':
        $user_obj->userDelete($_GET['id']);
        header('location:?c=users&a=list');
        break;
    case 'chat_history':
        $chat_history = $user_obj->chat_list();
        $doctors = new doctors();
        $user = new users();
        break;
    case 'cities':

//        $province_id = $_POST["province_id"];
        var_dump($_POST) ;
//        $cities = $obj->cities($province_id);
//        return $cities;
        break;
    case 'logout':
        setcookie('TF-Email','',time()-3600);
        header('location:/admin/login.php');
        break;
    case 'createInvoice' :
        $due_date_jalali = explode('/', $_POST["due_date_jalali"]);
        $due_date = $dateConvertor_obj->toGregorian($due_date_jalali[0],$due_date_jalali[1],$due_date_jalali[2],$due_date_jalali);
        $due_date = str_replace("/", "-", $due_date);
        $due_date_time = $due_date . ' ' . $_POST["due_time"];

        $invoice_id = $user_obj->createInvoice($_POST,$due_date_time);
        $user_obj->create_task($admin_info->id,$_POST,$invoice_id,$due_date_time);

        break;

    case 'invoicesList':
        $dateConvertor_obj = new dateConverter();
        if ($user_obj->findRoll($user_obj->find($admin_info->id)['roll'])['title'] == 'supporter'){
            $invoices = $user_obj->allInvoices();

        } else {
            $invoices = $user_obj->invoicesList($admin_info->id);

        }

        break;
    case 'deleteInvoice':
        $id = $_GET['id'];
        $user_obj->deleteInvoice($id);
        break;
        // User Finance Cases
    case 'rejectPayment' :
        $payment_id = $_GET['id'];
        $status = 'reject';
        $finance_obj->accOrRej($payment_id,$status,$admin_info->id);
        break;
    case 'acceptPayment':
        $payment_id = $_GET['id'];
        $status = 'accept';
        $finance_obj->accOrRej($payment_id,$status,$admin_info->id);
        break;
    case 'addEfile' :
        $provinces = $user_obj->provinces();
        $diseases = $user_obj->get_diseases();
        switch ($admin_info->roll_title){
            case 'site_admin':
            case 'admin':
                $customers = $user_obj->all_customers();
                break;
            case 'consultant':
                $customers = $user_obj->my_customers($admin_info->id);
                break;
        }
        break;
    case 'createEfile' :
        $user_birthday = explode('/', $_POST["user_birthday"]);
        $user_birthday = $dateConvertor_obj->toGregorian($user_birthday[0],$user_birthday[1],$user_birthday[2],$user_birthday);
        $user_last_childbirth = null;
        if ($_POST["user_last_childbirth"]) {
            $user_last_childbirth = explode('/', $_POST["user_last_childbirth"]);
            $user_last_childbirth = $dateConvertor_obj->toGregorian($user_last_childbirth[0],$user_last_childbirth[1],$user_last_childbirth[2],$user_last_childbirth);
        }

        $user_obj->user_efile_create($_POST,$user_birthday,$user_last_childbirth);
        break;
    case 'getUserDetails':
        $chats = $chat_obj->user_efile($_GET['id']);
//        $user_id = $_GET['id'];
//        $user_eFile = $user_obj->get_user_details($user_id);
//
//        $user_obj = new users();
//        $chat_history = $chat_obj->get_users_chats($user_id);
//        $chats = $chat_obj->get_history($user_id);
        break;
    case 'reviewed':
        $admin_obj->reviewed($_GET['id']);
        header('location:?c=index&a=index');
        break;
    case 'accept':
        echo $_GET['id'];
        $user_obj->accept_user($_GET['id']);
        header('location:?c=index&a=index');

        break;
    case 'userEfile':
        switch ($admin_info->roll_title){
            case 'site_admin':
            case 'admin':
                $customers = $user_obj->all_customers();
            break;
            case 'consultant':
                $customers = $user_obj->my_customers($admin_info->id);
            break;
        }


}
