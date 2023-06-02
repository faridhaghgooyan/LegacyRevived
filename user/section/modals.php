<!-- User Services Modal -->
<div id="servicesModal" class="modal fade"  role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">درخواست خدمت فوری</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3></h3>
                <form id="servicesModalForm" action="" method="POST" class="text-right">
                    <input id="service_id_input" type="hidden" name="service_id">
                    <input id="service_chat_code" type="hidden" name="chat_code">
                    <textarea name="message" id="" cols="30" rows="5" placeholder="توضیحات تکمیلی در خصوص ارائه خدمت"></textarea>
                    <button class="btn btn-success">ثبت درخواست</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-tootfarangee" data-dismiss="modal">خواندم</button>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
