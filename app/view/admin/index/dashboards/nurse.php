<!--========== PHP ==========-->
<?php
//    dd($ready_invoices);
?>
<!--========== Page Styles ==========-->

<!--========== Page Content ==========-->
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
                            <td> <?php echo $i?> </td>
                            <?php $pic = $user->find($task['customer_id'])['pic']; ?>
                            <td >
                                <div style="
                                    background-image: url(<?php echo $pic?>);
                                    background-size: cover;
                                    background-position: center;
                                    height: 50px;
                                    width: 50px;
                                    border-radius: 50%;
                                    border: 1px solid #c8c8c8;
                                    background-color: white;
                                    "> </div>
                            </td>
                            <td>
                                <?php echo $user->find($task['customer_id'])['firstName'].' '.$user->find($task['customer_id'])['lastName']?>
                            </td>
                            <td>
                                <?php echo $user->find($task['customer_id'])['mobile']?>
                            </td>

                            <td>
                                <?php echo $dateConvertor_obj->dateConvert($task['due_date_time'])[0]['date'];?>
                            </td>

                            <td>
                                <button
                                class="btn btn-primary"
                                onclick="modals.show(`<?php echo $task['creator_comment'];?>`)"
                                >
                                    <i class="fas fa-comment"></i>
                                </button>
                                <abbr title="پرونده زیباجو">
                                    <a class="btn bg-tootfarangee btn-sm" href="?c=users&a=getUserDetails&id=<?php echo $task['customer_id']; ?>" >
                                        <i class="fas fa-user"></i>
                                    </a>
                                </abbr>
                                <button
                                        class="btn btn-success"
                                        onclick="modals.addComment(event,<?php echo $task['task_id']; ?>)"
                                >
                                    <i class="fas fa-check"></i>

                                </button>

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
<!--========== Page Scripts ==========-->
<script src="../global_assets/js/chat_main.js"></script>
<script src="assets/js/functions.js"></script>