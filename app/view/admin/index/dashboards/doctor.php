<?php require '../app/controllers/admin/doctors.php'?>
<section class="content-wrapper" style="padding: 20px">
    <div class="container-fluid">
        <div class="page-content row shadow" >
            <h6>لیست کارها</h6>
            <hr>
            <div class="col-sm-12">
                <table class="table table-striped myTable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>پروفایل</td>
                        <td>نام زیباجو</td>
                        <td>شماره یونیک</td>

                        <td>نوع</td>
                        <td>تاریخ مراجعه</td>
                        <td>تاریخ</td>
                        <td>ساعت</td>
                        <td>مبلغ - ریال</td>
                        <td>ابزار کنترل</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; foreach ($tasks as $task) :?>

                        <tr class="">
                            <td><?php echo $i?></td>
                            <?php $pic = $user->find($task['customer_id'])['pic']; ?>
                            <td ><div style="
                                    background-image: url(<?php echo $pic?>);
                                    background-size: cover;
                                    background-position: center;
                                    height: 50px;
                                    width: 50px;
                                    border-radius: 50%;
                                    border: 1px solid #c8c8c8;
                                    background-color: white;
                                    "> </div></td>
                            <td><?php echo $user->get_user_name($task['customer_id'])?></td>
                            <td><?php echo $task['invoice_unique_id']?></td>
                            <td><?php echo $task['invoice_unique_id']?></td>
                            <td>
                                <?php echo $task['title']?>
                            </td>
                            <td>
                                <?php echo $dConverter->dateConvert($task['due_date_time'])[0]['date']?>
                            </td>
                            <td>
                                <?php echo $dConverter->dateConvert($task['due_date_time'])[0]['time']?>
                            </td>
                            <td>
                                <?php echo number_format($task['final_price'])?>
                            </td>
                            <td>

                                <abbr title="توضیحات پذیرش">
                                    <a class="btn btn-warning btn-sm" href="#" onclick="getMessage('<?php echo $task['description']?>')">
                                        <i class="fas fa-comment">
                                        </i>
                                        <input type="hidden" value="<?php echo $task['comment']?>" id="comment<?php echo $i?>" class="comment">
                                    </a>
                                </abbr>

                                <abbr title="پرونده زیباجو">
                                    <a class="btn bg-tootfarangee btn-sm" href="?c=users&a=galleries&id=<?php echo $task['customer_id']?>" >
                                        <i class="fas fa-user"></i>
                                        <input type="hidden" value="<?php echo $task['comment']?>" id="comment<?php echo $i?>" class="comment">
                                    </a>
                                </abbr>
                                <abbr title="تایید انجام این وظیفه">
                                    <a class="btn btn-success btn-sm" href="#" onclick="drDoneTask('<?php echo $task['task_id']?>')">
                                        <i class="fas fa-check">
                                        </i>
                                        <input type="hidden" value="<?php echo $task['comment']?>" id="comment<?php echo $i?>" class="comment">
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
    </div>
    <!-- Require Modals -->
<!--    --><?php //require 'section/modals.php';?>
</section>
