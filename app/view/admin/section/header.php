<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" lang="fa">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php
        if (isset($userName)){
            echo $userName;
        } else {
            echo 'مدیر';
        }
        ?>
        عزیز خوش آمدید | کنترل پنل
    <?php
        if (isset($user_roll_faTitle)){
            echo $user_roll_faTitle;
        } else {
            echo 'مدیریت';
        }
    ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Custom CSS -->
    <link href="../global_assets/css/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="../global_assets/css/kamadatepicker.min.css">

    <!-- ./. Custom CSS -->

    <link rel="stylesheet" href="dist/css/admin.css">
    <link rel="fstylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="/global_assets/css/jquery.dataTables.min.css">
<!--    <link rel="stylesheet" href="assets/css/modals.css">-->
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="/global_assets/css/chat.css">
    <link rel="stylesheet" href="dist/css/fontawesome.min.css">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="dist/css/bootstrap-theme.css">

    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="dist/css/rtl.css">

    <!-- persian Date Picker -->
    <link rel="stylesheet" href="dist/css/persian-datepicker-0.4.5.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="/global_assets/css/general.css" />
    <link rel="stylesheet" href="/admin/assets/css/notes.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <?php require '../app/view/admin/section/main-header.php'?>
        <?php require_once '../app/view/admin/section/modals.php'; ?>

    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php require '../app/view/admin/section/sidebar.php'?>
        <!-- /.sidebar -->
    </aside>


    <!-- /.content-wrapper -->
