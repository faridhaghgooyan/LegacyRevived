<?php
use App\Model\payment;
use App\Model\Zarinpal;
use App\Model\invoice;
require_once 'app/Model/users.php';
require_once 'app/Model/payments.php';
require_once 'app/Model/invoices.php';
require_once 'app/Model/Zarinpal.php';
$users_obj = new users();
$payments_obj = new payment();
$invoice_obj = new invoice();
$zarinpal_obj = new Zarinpal();
if ($_GET['Status'] == 'OK'){
    $payment = $payments_obj->find_by_tracking_code($_GET['Authority']);
    $transaction_id = $zarinpal_obj->verify($payment['price']);
    $payments_obj->success_payment($_GET['Authority'],$transaction_id);
} else {
}
?>
<?php include_once "user/section/header.php"; ?>


<?php
include_once "user/section/scripts.php";
include_once "user/section/footer.php";
?>