<?php require '../app/controllers/admin/supporter.php'?>
<section class="content-wrapper" style="padding: 20px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 page-content row shadow" >
                <h6>وظایف آماده برای دکتر</h6>
                <hr>
                <table class="table table-striped myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>زیبا جو</th>
                        <th>شماره همراه</th>
                        <th>نام دکتر </th>
                        <th>نظر پزشک</th>
                        <th>تاریخ مراجعه / عمل</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tasks as $task): ?>

                        <tr>
                            <td>#</td>
                            <td><?php echo $task['title']?></td>
                            <td><?php
                                $user = $user_obj->find($task['customer_id']);
                                echo $user['firstName'] . ' ' .$user['lastName'];
                                ?>
                            </td>
                            <td><?php
                                $user = $user_obj->find($task['customer_id']);
                                echo $user['mobile'];
                                ?>
                            </td>
                            <td><?php
                                $user = $user_obj->find($task['operator_id']);
                                echo $user['firstName'] . ' ' .$user['lastName'];
                                ?>
                            </td>
                            <td>
                                <p class="">
                                    <?php echo $task['operator_comment']?>
                                </p>

                            </td>
                            <td>
                                <?php
                                $jalali = $dateConvertor_obj->date_convert($task['due_date_time'],'jalali')[0]['date'];
                                echo $jalali;
                                ?>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>


            </div>
            <div class="col-sm-12 page-content row shadow" >
                <h6>وظایف آماده برای پرستار</h6>
                <hr>
                <table class="table table-striped myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>زیبا جو</th>
                        <th>شماره همراه</th>
                        <th>نام پرستار </th>
                        <th>تاریخ مراجعه / عمل</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($nurse_tasks_list as $nurse): ?>

                        <tr>
                            <td><?php echo $nurse['id']?></td>
                            <td><?php echo $nurse['title']?></td>
                            <td><?php echo $nurse['firstName'] . ' ' . $nurse['lastName']?></td>
                            <td><?php echo $nurse['mobile']?></td>
                            <td><?php echo $nurse['first_name'] . ' ' . $nurse['last_name']?></td>
                            <td><?php echo $dConverter->date_convert($nurse['due_date_time'],'jalali')[0]['date'] . ' / ' . $dConverter->date_convert($nurse['due_date_time'],'jalali')[0]['time']?></td>




                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>


            </div>

        </div>

        <hr>
        <br>
    </div>
    <!-- Require Modals -->
<!--    --><?php //require '/app/view/admin/section/modals.php';?>
    <script src="../global_assets/js/adminController.js"></script>

</section>