function userReqDetail(id){
    let modal = $('#publicModal');
    let modalBody = $('#publicModal .modal-body');
    let title = $('#publicModalSubject');
    let message = $('#'+id).val();
    modalBody.empty();
    title.append('شرح درخواست :');
    modalBody.append('<p>'+message+'</p>');
    modal.modal('show');

}
function nurseModal(taskId,nurseId){
    let modal = $('#nurseModal');
    let modalBody = $('#nurseModal .modal-body');
    let nurseForm = $('#nurseDueForm');
    nurseForm.prepend('<input type="hidden" name="task_id" value="' + taskId + '">');

    modal.modal('show');

}
function supporterComment(commentID){
    let creatorComment = $('#' + commentID).val();
    let modal = $('#commentModal');
    let modalBody = $('#commentModal .modal-body');
    if (creatorComment){
        modalBody.empty().append('<p class="curve-border">'+creatorComment+'</p><br>');
    } else {
        modalBody.empty().append('<p>بدون توضیح میباشد.</p>');
    }
    modal.modal('show');

}
function getUserDetails(id){

    $.ajax({
        url : '?api=users&a=getUserDetails&id='+id,
        method : 'get',
        dataType : 'json',
        success : function (result){
            $('#customerDetailsModal').modal('show');
            console.log(result);
        },
        error : function (xhr){
            console.log(xhr);
        }
    })
}
function getThisChat(chatPlace,chatID){
    let chatDivPlace = "#chatPlace" + chatPlace;
    let data = '../chat_history/' + chatID;
    $.get(data).done(function(result){
        console.log(result);
        // Load All Data
        for (let i in result){
            let userMessage = '<div class="user-chat-box text-right mr-4 mt-2 ">'+result[i].text+'</div>';
            let userImage = '<a href="'+result[i].filePath+'" target="_blank"><img src="'+result[i].filePath+'" data-path="'+result[i].filePath+'" class="user-chat-img shadow" width="150"></a>';
            if (result[i].type == 'user'){
                switch (result[i].fileType) {
                    case null :
                        $('#chatPlace'+chatPlace).append(userMessage);
                        break;
                    case 'image/jpg':
                        $('#chatPlace'+chatPlace).append(userImage);
                        break;
                    case 'audio/wav':
                        $('#chatPlace'+chatPlace).append('<audio controls class="p-2 " > <source src="'+result[i].filePath+'" type="audio/ogg"></audio><br>\n')
                        break;
                }
            } else if (result[i].type == 'admin'){
                switch (result[i].fileType) {
                    case null :
                        $('#chatPlace'+chatPlace).append('<div class="admin-chat-box text-right mr-4 mt-2 ">'+result[i].text+'</div>');
                        break;
                    case 'image/jpg':
                        $('#chatPlace'+chatPlace).append('<a href="'+result[i].filePath+'" target="_blank"><img src="'+result[i].filePath+'" data-path="'+result[i].filePath+'" class="user-chat-img shadow" width="150"></a>');
                        break;
                }
            }
        }

    })
}
function drDoneTask(task_id){
    let modal = $('#drCommentModal');
    let modalBody = $('#drCommentModal .modal-body');
    let form = $('#drCommentForm');
    $('input[name="task_id"]').remove();
    form.prepend('<input name="task_id" type="hidden" value="' + task_id + '">');
    modal.modal({
        show : 'true',
        backdrop : 'static',
        keyboard : false
    })
}
function sweetAlert(message,title = "توضیحات"){
    Swal.fire({
        icon: 'info',
        title: title,
        text: message,
        confirmButtonText: "متوجه شدم",
    })
}