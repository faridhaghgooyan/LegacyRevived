<?php
namespace App\Model;
class Uploader {
    public function __construct() {
        global $db;
        $this->db=$db;
    }
    public function chat_uploader($file,$path){
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                echo "یک تصویر است - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "فایل تصویر نیست!";
                $uploadOk = 0;
            }
        }
        if (file_exists($path)) {
            echo "این فایل وجود دارد.";
            $uploadOk = 0;
        }

        if ($file["size"] > 500000) {
            echo "حجم فایل زیاد است.";
            $uploadOk = 0;
        }

        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
            && $fileType != "gif" && $fileType != "pdf" && $fileType != "mp3" && $fileType != "wav" ) {
            echo "فقط پسوند های jpg.png,jpeg و gif و PDF و wav مجاز هستند.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $path)) {
                return $path;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    public function upload($file){
        $target_dir = "storage/profile/";
        $new_name = basename(rand().'.jpg');
        $path = "storage/profile/".$new_name;
        $target_file = $path;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

// Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            var_dump($new_name);

            var_dump($file["tmp_name"]);
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "فایل ". htmlspecialchars( basename( $file["name"])). "آپلود شد.";
            } else {
                echo "با عرض پوزش خطایی رخ داده است";
            }
        }
        return $path;
    }
    public function fileUpload($file,$folder){
        $new_name = basename(rand().'.jpg');

        $path = "../storage/$folder/".$new_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
// Check if file already exists
        if (file_exists($path)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

// Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "فایل آپلود نشد!";
// if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($file["tmp_name"], $path)) {
//                echo $path;
            } else {
                echo "با عرض پوزش خطایی رخ داده است";
            }
        }
        return "/storage/$folder/".$new_name;
    }
    public function chat_files($user_id,$title,$file_name){
        $this->db->query("insert into chat_files(user_id,title,file_name) values('$user_id','$title','$file_name')");
    }
    public function update_chat_files($file_name,$user_id){
        $this->db->query("update chat_files set user_id='$user_id' where file_name='$file_name'");

    }
    public function uploader($file){
            $target_dir = dirname(__DIR__,2)."/storage/";
            $file_mime_type = mime_content_type($file['tmp_name']);
            $file_name = '';
            $error = [];
    // Check Data Type
            switch ($file_mime_type){
                case "image/jpeg":
                    $file_name = rand() .  basename($file["name"]);
                    $target_dir = dirname(__DIR__,2)."/storage/image/";

                    break;
                case "audio/x-wav":
                    $file_name = rand() . basename($file["name"]).".wav";
                    $target_dir = dirname(__DIR__,2)."/storage/voice/";
                    break;
            }
            $target_file = $target_dir . $file_name;
            $uploadOk = 1;
    // Check file size
            if ($file["size"] > 500000) {
                array_push($error,"حجم فایل شما بیش از 5 مگابایت است!");
                $uploadOk = 0;
            }
    // Allow certain file formats
            if($file_mime_type != "image/jpeg" && $file_mime_type != "image/png" && $file_mime_type != "image/jpg" && $file_mime_type != "audio/x-wav"
                && $file_mime_type != "image/gif" ) {
                array_push($error,"با عرض پوزش ، فقط فرمت های JPG , PNG , GIF , Wav قابل قبول میباشد!");
                $uploadOk = 0;
            }
    // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                return [
                    "upload_status"=>$uploadOk,
                    "path"=>$file_name,
                    "error"=>$error
                ] ;

    // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return [
                        "upload_status"=>$uploadOk,
                        "path"=>$file_name,
                        "error"=>$error
                    ] ;
                } else {
                    array_push($error,"با عرض پوزش ، عملیات آپلود دچار ایراد است!");
                    return [
                        "upload_status"=>$uploadOk,
                        "path"=>$file_name,
                        "error"=>$error
                    ] ;
                }
            }
        }

}