<script src="../global_assets/js/adminController.js"></script>

<section class="content-wrapper" style="padding: 20px">
    <div class="container-fluid">
        <div class="page-content row shadow" >
            <h6>لیست کارها</h6>
            <hr>
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>پروفایل</th>
                            <th>نام درخواست کننده</th>
                            <th>شماره همراه</th>
                            <th>تاریخ مراجعه</th>
                            <th>ابزار کنترل</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($tasks as $task) :?>
                    <?php
        
                        ?>

                        <tr >
                            <td>
                                <?php echo $task['id'] ?>
                            </td>
                            <td>
                                <img src="<?php echo $task['pic'] ?>" width="50">
                            </td>
                            <td> <?php echo $task['lastName'] ?> </td>
                            <td> <?php echo $task['mobile'] ?> </td>
                            <td> <?php echo  $dConverter->date_convert($task['due_date_time'],'jalali')[0]['date'] ?> </td>

                            <td>
                                <abbr title="توضیحات پشتیبان">
                                    <a class="btn btn-primary btn-sm" href="#" onclick="supporterComment('comment<?php echo $task['task_id'];?>')">
                                        <i class="fas fa-comment"></i>
                                        <input type="hidden" value="<?php echo $task['creator_comment']?>" id="comment<?php echo $task['task_id'];?>" class="comment">

                                    </a>
                                </abbr>
                                <abbr title="پرونده زیباجو">
                                    <a class="btn bg-tootfarangee btn-sm" href="?c=users&a=getUserDetails&id=<?php echo $task['customer_id']; ?>" >
                                        <i class="fas fa-user"></i>
                                    </a>
                                </abbr>
                                <abbr title="تایید انجام وظیفه و توضیحات">
                                    <a class="btn btn-info btn-sm"

                                       onclick="nurseModal('<?php echo $task['task_id'];?>','<?php echo $admin_info->id ;?>')">
                                        <i class="fas fa-history"></i>

                                    </a>
                                </abbr>
                            </td>
                        </tr>
                        <?php $i++;endforeach; ?>

                    </tbody>
                </table>
            </div>

        </div>
        <hr>
        <br>
        <a href="?c=nurses&a=tasks_list">مشاهده تمام کارها</a>
    </div>
    <!-- Require Modals -->
<!--    --><?php //require 'section/modals.php';?>
</section>