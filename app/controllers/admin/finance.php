<?php
use App\Model\supporter;
use App\Model\doctor;
use App\Model\nurse;
use App\Model\dateConverter;
use App\Model\finance;
use App\Model\payment;
require_once '../app/models/supporter.php';
require_once '../app/models/users.php';
require_once '../app/models/doctors.php';
require_once '../app/models/nurses.php';
require_once '../app/models/dateConverter.php';
require_once '../app/models/finance.php';
require_once '../app/models/payments.php';
// Create Object of Classes
$users_obj = new users();
$doctors_obj = new doctor();
$nurse_obj = new nurse();
$dConverter = new dateConverter();
$supporter = new supporter();
$finance = new finance();
$payments_obj = new payment();

//Global Variable
$payment_count = count($finance->newPayments());
$payments = $finance->payments();

switch ($action) {
    case 'invoicesList':
    case 'unpaidInvoices':
    case 'oldInvoices' :

    $invoices = $finance->invoicesList();

        break;
    case 'newPayments':
        $payments = $finance->payments();
        break;

        case 'changeStatus' :
            $id = $_GET['id'];
            $data = $_POST["paymentStatus"];
            $finance->changeStatus($data,$id,$admin_info->id);
        break;
    case 'acceptedPayments':
        $payments = $payments_obj->payments_list();
        $dConverter = new dateConverter();
        break;


}
