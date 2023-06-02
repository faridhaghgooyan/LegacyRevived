<div class="col-sm-12 stretch-card grid-margin h-50">
    <div class="card">
        <div class="card-body pb-0">
            <h4 class="card-title mb-0 rtl">لیست خدمات انجام شده </h4>
        </div>
        <div class="card-body p-0 rtl">
            <div class="table-responsive">
                <table class="table custom-table text-dark">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>دکتر / پرستار</th>
                        <th>وضعیت مالی</th>
                        <th>تاریخ</th>
                        <th>مدیریت</th>
                    </tr>
                    </thead>
                    <?php $i=1;foreach ($doneTasks as $task) :?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>
                                <img src="../<?php echo $user->find($task['adminuser_id'])['pic'] ?>" class="ml-2 " alt="image"  />
                                <?php echo $user->find($task['adminuser_id'])['lastName'] ?>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <?php if ($task['has_invoice']): ?>
                                        <span class="pr-2 d-flex align-items-center">
                                        <?php $percent =  $user->checkPaymentPercent($task['task_id']);  ?>
                                        <?php if ($percent < 100): ?>
                                            <?php echo $percent;?>

                                            %</span>
                                            <input class="priceRange" type="range" value="<?php echo $percent; ?>" disabled style="color: red!important;">
                                            <span class="text-danger">تسویه نشده</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">تسویه شده</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-dark">فاکتور صادر نشده</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($task['has_invoice']){
                                    echo $task['due_date_jalali'];
                                }else {
                                    echo '<span class="badge badge-warning">در دست بررسی</span>';
                                }?>
                            </td>
                            <td>
                                <a href="?c=users&a=pay&id=<?php echo $user->getInvoice($task['task_id'])["task_id"];?>" class="btn btn-success">پرداخت فاکتور</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>