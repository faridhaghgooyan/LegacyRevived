<?php
use app\models\payments;
use app\models\Zarinpal;
use app\models\invoices;
require_once 'app/models/users.php';
require_once 'app/models/payments.php';
require_once 'app/models/invoices.php';
require_once 'app/models/Zarinpal.php';
$users_obj = new users();
$payments_obj = new payments();
$invoice_obj = new invoices();
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