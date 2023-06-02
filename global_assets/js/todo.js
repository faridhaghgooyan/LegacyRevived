function newTodo(){
    if ($('#checkModalOpen').val() != 1){
        $.ajax({
            url : '?api=todo&a=newTodo',
            method: 'post',
            dataType : 'json',
            success : function (resultData){

                // console.log("newTodo() Result :");
                // console.log(resultData);
                if (resultData.length > 0){
                    let i = 0;
                    let modal = $('#reminderContentModal');
                    let modalBody = $('#reminderContentModal .modal-body');
                    let modalFooter = $('#reminderContentModal .modal-footer');
                    let customer_name = $('#customer_name');
                    let due_date = $('#due_date');
                    let due_time = $('#due_time');
                    let id = resultData[i]['id'];
                    let chat_code = resultData[i]['chat_code'];
                    //Clear Data
                    //
                    // console.log(resultData[i]['id']);
                    customer_name.append(resultData[i]['userName']);
                    due_date.append(resultData[i]['jalali_date']);
                    due_time.append('23:58:00');
                    $('#showUserDetails').attr('href', '?c=index&a=index#usersChatList'+resultData[i]['chat_code'])
                    modalBody.append('<p class="alaramMessage" style="margin: 5px;border-radius: 10px;border: 1px dashed lightgrey;padding: 5px">' + resultData[i]['message'] + '</p>');
                    modalFooter.append('<a href="?c=todo&a=edit&id=' + id + '" class="btn btn-info">تغییر به زمان دیگر</a>');
                    modalFooter.append('<a href="?c=todo&a=done&chat_code='+chat_code+'&id=' + id + '" class="btn btn-success">تایید انجام کار</a>');
                    modalFooter.append('<input id="checkModalOpen" value="1" type="hidden">');


                    modal.modal({
                        show : 'true',
                        backdrop : 'static',
                        keyboard : false
                    })
                    checkNewTodo();
                }
            },
            error : function (xhr){
                console.log('newTodo() Error : ');
                console.log(xhr);
            }
        })

    }
}
checkNewTodo();

function checkNewTodo(){
    setInterval(function (){
        newTodo();
    },1000)

}
function selectBox(box){
    let url = window.location.href;
    let home = "https://clog.tootfarangee.com/admin/?c=index&a=index";
    let target_link = "https://clog.tootfarangee.com/admin/?c=index&a=index#"+box;
    if (url != home){
        window.location.replace(target_link)
    } else {
        $('#'+box).click();
    }

}
