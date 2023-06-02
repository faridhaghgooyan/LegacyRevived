<div class="col-sm-12 stretch-card grid-margin h-50">
    <div class="card">
        <div class="card-body pb-0">
            <h4 class="card-title mb-0 rtl">فاکتور های تسویه شده </h4>
        </div>
        <div class="card-body p-0 rtl">
            <div class="table-responsive">
                <table class="table custom-table text-dark">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>شماره فاکتور</th>
                        <th class="font-weight-bold">مبلغ کل</th>
                        <th>مانده</th>
                        <th>تاریخ صدور</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (count($invoices) > 0): ?>
                        <?php $i=1;foreach ($invoices as $task) :?>
                            <?php if ($user->paymentsForTask($task['task_id']) === 0) : ?>
                                <tr>
                                    <td>
                                        <?php echo $i;?>
                                    </td>
                                    <td>
                                        <?php echo $user->getInvoice($task['task_id'])['unique_id']?>
                                    </td>
                                    <td class="font-weight-bold">
                                        <?php echo number_format($user->getInvoice($task['task_id'])['price'])?>
                                    </td>
                                    <td>
                                        0
                                        <span class="badge badge-success mr-3">تسویه شده</span>
                                    </td>
                                    <td>
                                        <?php echo $user->getInvoice($task['task_id'])['created_at']?>
                                    </td>


                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>