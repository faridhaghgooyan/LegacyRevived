
// Load User Message
let chat_code = $('input[name="chat_code"]').val()+'.json';
function loadUserMessages(chatFile){
    let data = '../chat_history/' + chatFile;

    let messageBox = $('#chatMainBox');
    if (data){
        $.get(data).done(function(result){
            // Load All Data
            for (let i in result){
                console.log('result');
                console.log(result);
                if (result[i].type == 'user'){
                    switch (result[i].fileType) {
                        case null :
                            messageBox.append('<div class="user-chat-box text-right mr-4 mt-2 ">'+result[i].text+'</div>');
                            break;
                        case 'image/jpg':
                            messageBox.append('<a href="'+result[i].filePath+'" target="_blank"><img src="'+result[i].filePath+'" data-path="'+result[i].filePath+'" class="user-chat-img shadow" width="150"></a>');
                            break;
                        case 'audio/wav':
                            messageBox.append('<audio controls class="p-2 " > <source src="'+result[i].filePath+'" type="audio/ogg"></audio><br>\n')
                            break;
                    }
                }
            }
            scroller();

        })

        realTimeAdminResponse(chatFile);
    }
}
loadUserMessages(chat_code);
// Send Message and Show to User
$('.sendMessage').on('click keypress', function (e) {
    // Chat Variables
    let formData = new FormData(document.querySelector('#userChatForm'));
    let message = $('#userMessage').val();
    if (e.which === 1 || e.which === 13 && message.length > 3) {
        // Send Data to PHP Script
        $.ajax({
            url: "?api=chat&a=store",    //the page containing php script
            type: "POST",    //request type,
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.message.length > 0){
                    $('#chatMainBox').append('<div class="user-chat-box text-right mr-4 mt-2 ">'+result.message+'</div>');
                }
                if (result.filetype != null) {
                    switch (result.filetype){
                        case 'image/jpg':
                            $('#chatMainBox').append('<a href="'+result.path+'" target="_blank"><img src="'+result.path+'" data-path="'+result.path+'" class="user-chat-img shadow" width="150"></a>');
                            break;
                        case 'application/pdf':
                            $('#chatMainBox').append('<a href="'+result.path+'" target="_blank" class="btn btn-success">دانلود فایل PDF</a>')
                            break;
                    }
                }
                // console.log('result');
                // console.log(result);
                scroller();
               emptyInput();
            },
            error: function (xhr, status, error) {
                console.log('resError:');
                console.log(xhr);

            }
        });

    }

});


function realTimeAdminResponse(chatFile){
    let data = '../chat_history/' + chatFile;
    let messageBox = $('#chatMainBox');
    let flag = 0;
    if (data){
        setInterval(function (){
            $.get(data).done(function(result){
                console.log(result.length);
                let id = result.length - 1;
                if (flag < result.length){
                    if (result[id].type == "admin"){
                        switch (result[id].fileType) {
                            case null :
                                messageBox.append('<div class="admin-chat-box text-right mr-4 mt-2 here">'+result[id].text+'</div>');
                                scroller();
                                break;
                            case 'image/jpg':
                                messageBox.append('<a href="'+result[id].filePath+'" target="_blank"><img src="'+result[id].filePath+'" data-path="'+result[id].filePath+'" class="user-chat-img shadow" width="150"></a>');
                                scroller();
                                break;
                            case 'audio/wav':
                                messageBox.append('<audio controls class="p-2 " > <source src="'+result[i].filePath+'" type="audio/ogg"></audio>\n')
                                break;
                        }
                        flag = result.length;
                    }
                }


            })
        },500)
    }
}

// Scroll To End
function scroller(){
    let element = document.getElementById('chatMainBox');
    element.scrollTop = element.scrollHeight;
}
// Empty User and Admin Message Input
function emptyInput(){
    $('#userMessage').val('');
    $('#adminMessage').val('');

}
/* Admin Functions */

//Get New Chats
// function reatTimeShow(chatFile){
//     // Load All Data
//     let messageBox = $('#chatMainBox');
//     $.get(chatFile).done(function(result){
//         for (let i in result){
//             if (result.length > resultLenght){
//                 switch (result[id].fileType) {
//                     case null :
//                         messageBox.append('<div class="user-chat-box text-right mr-4 mt-2 ">'+result[id].text+'</div>');
//                         resultLenght++;
//                         break;
//                     case 'image/jpg':
//                         messageBox.append('<a href="'+result[id].filePath+'" target="_blank"><img src="'+result[id].filePath+'" data-path="'+result[id].filePath+'" class="user-chat-img shadow" width="150"></a>');
//                         resultLenght++;
//                         break;
//                 }
//             }
//         }
//     })
//     let resultLenght = 0;
//     setInterval(function () {
//         $.get(chatFile).done(function(result){
//             let id = (result.length)-1;
//
//             for (let i in result){
//                 if (result.length > resultLenght){
//                     switch (result[id].fileType) {
//                         case null :
//
//                             $('#chatMainBox').append('<div class="user-chat-box text-right mr-4 mt-2 ">'+result[id].text+'</div>');
//                             resultLenght++;
//
//                             break;
//                         case 'image/jpg':
//
//
//                             $('#chatMainBox').append('<a href="'+result[id].filePath+'" target="_blank"><img src="'+result[id].filePath+'" data-path="'+result[id].filePath+'" class="user-chat-img shadow" width="150"></a>');
//                             resultLenght++;
//
//
//                             break;
//                     }
//                 }
//                 console.log(resultLenght);
//                 console.log(i);
//             }
//             console.log(id);
//             console.log(resultLenght);
//         })
//     }, 1000);
//     console.log(resultLenght);
// }
function sendTochatMainBox(message){
    $('#chatMainBox').append('<div class="user-chat-box text-right mr-4 mt-2 ">'+result[i].text+'</div>');
}

// Actions of Modals
function servicesReq(serviceID){
    let serviceName= $('#'+serviceID).data('service_name');
    let id = $('#'+serviceID).data('id');
    let header = $('#serviceName');
    let formBody = $('#servicesModal .service-info');
    let serviceForm = $('#serviceForm');
    header.empty();
    formBody.empty();
    $('#service_id').remove();
    header.append(serviceName);
    $.ajax({
        url : '?api=users&a=showService&id='+id,
        method : 'post',
        dataType : 'json',
        success : function (result){
            let service_id = result['id'];
            let pic = result['pic'];
            let description = result['description'];
            //
            serviceForm.append('<input id="service_id" type="hidden" name="service_id" value="'+service_id+'">');
            formBody.prepend('<p class="text-center mt-2" >'+description+'</p>');
            formBody.prepend('<img src="'+pic+'" class="circle-img shadow" width="120" height="120">');
            $('#servicesModal').modal('show');
        },
        error : function (xhr){
            console.log(xhr);
        }
    })
    $('#servicesModal').modal('show');

}
