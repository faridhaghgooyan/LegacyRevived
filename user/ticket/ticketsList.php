<div class="col-sm-12 stretch-card grid-margin ">
    <div class="card">
        <div class="card-body pb-0">
            <h4 class="card-title mb-0 rtl">لیست پیام ها </h4>
            <br>
        </div>
        <div class="card-body p-0 rtl">
            <div class="table-responsive">
                <table class="table custom-table text-dark">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>تاریخ</th>
                        <th>مدیریت</th>
                    </tr>
                    </thead>
                    <?php
                    $i = 1;
                    $code = 0;
                    foreach ($tickets as $ticket) :?>
                    <?php
                        if ($code != $ticket['code'] ) :
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td>
                                <?php echo $ticket['title']; ?>
                            </td>

                            <td>
                                <?php echo $ticket['updated_at']; ?>
                            </td>
                            <td>
                                <a href="?c=ticket&a=read&code=<?php echo $ticket['code'];?>"
                                   class="btn btn-success m-0 p-1">

                                    <i class="fa fa-eye" style="font-size: 0.9rem"></i>
                                </a>
                            </td>

                        </tr>
                    <?php
                            $code = $ticket['code'];
                            $i++;
                            ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>