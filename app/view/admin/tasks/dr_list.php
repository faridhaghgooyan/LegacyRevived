<link rel="stylesheet" href="../assets/css/chats.css">
<style>
    .bg-whatsapp{
        min-height: 250px;
        max-height: 60vh;
        overflow: auto;
        background-image: url("../storage/chatbackground.jpg");
        background-repeat: repeat;
        background-size: 210px;
        border-radius: 10px;
        padding: 10px;
    }
    .drComment{
        width: 100%;
        border-radius: 10px;
        margin: 10px 0px;
        min-height: 100px;
        padding: 10px;
        border: 1px solid lightgrey;
    }
    .select{
        color: black;
        width: 100%;
        border: 1px solid lightgrey;
        border-radius: 10px;
        padding: 5px;
        transition: 0.5s;
        margin: 5px 0px;
    }
    .select:hover{
        cursor: pointer;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>
<section class="content-wrapper">
    <hr>
    <div class="page-content">
        <i class="fas fa-user-md font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">لیست وظایف</span>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>شماره وظیفه</th>
                <th>عنوان وظیفه</th>
                <th>خدمت به </th>
                <th>توسط</th>
                <th>تاریخ وظیفه</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($tasks as $task):?>
                <tr class="d-flex align-items-self">
                    <td><?php echo $i?></td>
                    <td><?php echo $task['task_id']?></td>
                    <td><?php echo $task['title']?></td>
                    <td><?php echo $task['firstName'].' '.$task['lastName']?></td>
                    <td><?php echo $task['first_name'].' '.$task['last_name']?></td>
                    <td><?php echo $dConverter->dateConvert($task['due_date_time'])[0]['date'].' / '.$dConverter->dateConvert($task['due_date_time'])[0]['time']?></td>
                    <td>
                        <abbr title="ویرایش اطلاعات">
                            <a href="?c=tasks&a=dr_edit&id=<?php echo $task['task_id']?>" class="btn btn-warning btn-sm" >
                                <i class="fas fa-edit"></i>
                            </a>
                        </abbr>
                        <abbr title="حدف اطلاعات">
                            <a href="?c=tasks&a=task_delete&id=<?php echo $task['task_id']?>" class="btn btn-danger btn-sm" >
                                <i class="fas fa-trash"></i>
                            </a>
                        </abbr>


                    </td>
                </tr>
                <?php $i++;endforeach; ?>

            </tbody>
        </table>

    </div>


    <!-- Require Modals -->
    <?php require 'section/modals.php';?>


</section>

<script src="../assets/js/users.js"></script>
<script src="../global_assets/js/chat.js"></script>
