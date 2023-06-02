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
</style>
<section class="content-wrapper">
    <hr>
    <div class="page-content">
        <i class="fas fa-user-md font-1-rem d-inline"></i>
        <span class="iransans font-1-rem d-inline">لیست پیام</span>
        <a href="?c=drafts&a=add">+پیام جدید</a>
        <hr>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>متن</th>
                <th>تاریخ ایجاد</th>
                <th>کنترل</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; foreach ($sms_list as $sms):?>
                <tr class="d-flex align-items-self">
                    <td><?php echo $i?></td>
                    <td><?php echo $sms['text']?></td>
                    <td><?php echo $dateCovert->dateConvert($sms['created_at'])[0]['date'].' - '.
                            $dateCovert->dateConvert($sms['created_at'])[0]['time']
                        ;?></td>
                    <td>

                        <abbr title="ویرایش اطلاعات">
                            <a href="?c=drafts&a=read&id=<?php echo $sms['id']?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                        </abbr>
                        <abbr title="حدف اطلاعات">
                            <a href="?c=drafts&a=delete&id=<?php echo $sms['id']?>" class="btn btn-danger btn-sm">
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
