<?php
use App\Model\uploader;
require_once '..\models\uploader.php';

$file = $_FILES["fileToUpload"];
$mac = $_POST['mac_address'];
echo uploader::chat_uploader($file,$mac);
?>