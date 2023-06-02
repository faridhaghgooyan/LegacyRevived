<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>
        <?php if(isset($loggedUser_id)){
            echo $user->find($loggedUser_id)['firstName'].' '.$user->find($loggedUser_id)['lastName'];
        } ?>
         عزیز ، به توت فرنگی پلاس خوش آمدید.
    </title>
    <!-- plugins:css -->
    <script src="/global_assets/js/jquery.min.js"></script>
    <link rel="stylesheet" href="../user/assets//css/main.css" />

    <link rel="stylesheet" href="../user/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../user/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../user/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../user/assets/vendors/jquery-bar-rating/css-stars.css" />
    <link rel="stylesheet" href="../user/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../user/assets/css/demo_1/style.css" />
    <link rel="stylesheet" href="../user/assets/css/demo_1/custome.css" />
    <link rel="stylesheet" href="../user/assets/css/customStyles.css" />
    <link rel="stylesheet" href="../user/assets/css/all.min.css" />
    <link rel="stylesheet" href="/global_assets/css/general.css" />
    <!-- End layout styles -->

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->

</head>
<body class="bg-light">
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    <?php
    if (isset($_COOKIE['TF-Mobile'])){
        require 'section/sidebar.php';
    }
    ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <?php
        if (isset($_COOKIE['TF-Mobile'])){
            require 'section/top-header.php';
        }
        ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper pb-0">

