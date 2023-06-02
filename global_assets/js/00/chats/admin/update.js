// Load New Chats
function update_chat_list_old() {
    let next_id = 1;
    setInterval(function (){
        console.log(next_id);
        $.ajax({
            url: "?api=adminChat&a=loop&id="+next_id,
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.length > 0){
                    console.log(result);
                    for (let i in result){
                        next_id = (result[i]['id'] + result[i]['rowCount']) - 1;
                        append_chatBox(result[i]);
                        scroller();
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log('resError:');
                console.log(xhr);
            }
        });
    },5000)

}
function update_chat_list() {

    setInterval(function (){
        $.ajax({
            url: "?api=adminChat&a=new_chats",
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                if (result.length > 0){
                    for (let i in result){
                        // console.log(result[i]);
                        // check box exit
                        if ($('#usersChatList'+result[i]['id']).length == 0 && result[i]['id']){
                            append_chatBox(result[i]);
                        } else {
                            append_chats(result[i]);
                        }
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log('update_chat_list() :');
                console.log(xhr);
            }
        });
    },5000)

}
update_chat_list();
// Get User Chat
function loadMessages(code,divID){
    $('input[name=code]').val(code);
    let lastRow = 0;
    $.ajax({
        url: "?api=adminChat&a=loadMessages&code="+code,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.length > 0){
                let target = $('#chatMainBox');
                target.empty();
                for (let i in result){
                    if (result[i]['id']){
                        append_chats(result[i]);
                        lastRow = result[i]['id'];
                        scroller();
                    }
                }

                // update_chat(result[0]['code'],lastRow);
                $('#badge'+code).text('');
                $('.usersChatList').removeClass('active');
                $('#'+divID).addClass('active');
            } else {
                let target = $('#chatMainBox');
                target.empty();
                error_alert('فاقد سابقه چت');
            }
        },
        error: function (xhr, status, error) {
            console.log('Error => loadMessages() :');
            console.log(xhr);
        }
    });
}

// // my_chat_list()
// function next_chat(id)
// {
//     return id;
// }
// // my_chat_list()
// function get_loop(next_id)
// {
//     setInterval(function(){
//         next_id = next_id+1;
//         loop(next_id);
//     }, 6000);
//
// }
//
// function get_last_chats()
// {
//     $.ajax({
//         url: "?api=adminChat&a=get_last_chats",
//         type: "POST",
//         dataType: 'json',
//         processData: false,
//         contentType: false,
//         success: function (result) {
//             for (let i in result){
//                 console.log(result[i]);
//                 $('#usersChatList').prepend('' +
//                     '<div id="usersChatList'+i+'" class="usersChatList" onclick=loadMessages("'+result[i]['code']+'","usersChatList'+i+'")>' +
//                     '<img src="/storage/noimage.jpg" alt="" width="50">' +
//                     '<span>زیباجو ناشناس</span>'+
//                     '<span class="badge badge-red p-2">'+result[i]['rowCount']+'</span>'+
//                     '<abbr title="اختصاص به مشاور"><a class="" ><i onclick=consultantModal("'+result[i]['code']+'") class="fa fa-mail-forward"></i></a></abbr>'+
//                     '<abbr title="صدور فاکتور"><a class="" ><i onclick=factorModal("'+result[i]['code']+'") class="fa fa-dollar"></i></a></abbr>'+
//                     '<abbr title="ایجاد یادآور برای این چت"><a class="" ><i onclick=addTODO("'+result[i]['code']+'","'+result[i]['code']+'") class="fa ion-ios-alarm"></i></a></abbr>'+
//                     '</div>');
//
//             }
//             scroller();
//             emptyInput();
//         },
//         error: function (xhr, status, error) {
//             console.log('resError:');
//             console.log(xhr);
//         }
//     });
// }
// get_last_chats()

function append_chatBox(data){

    let html = '<div id="usersChatList'+data['id']+'" class="usersChatList" data-code="'+data['code']+'" onclick=loadMessages("'+data['code']+'","usersChatList'+data['id']+'")>';
    html += '<img src="/storage/noimage.jpg" alt="" width="50">';
    html += '<span>ناشناس</span>';

    // html += '<abbr title="اختصاص به مشاور"><a class="" ><i onclick=consultantModal("'+data['code']+'") class="fa fa-mail-forward"></i></a></abbr>';
    if (data['owner_id'] != null ){
        html += '<abbr title="صدور فاکتور"><a class="" ><i onclick=factorModal("'+data['code']+'") class="fa fa-dollar"></i></a></abbr>';
        html += '<abbr title="ایجاد یادآور برای این چت"><a class="" ><i onclick=addTODO("'+data['code']+'","'+data['code']+'") class="fa ion-ios-alarm"></i></a></abbr>';
    }
    if (data['user_check'] != 1 && data['has_seend'] == 0){
        html += '<span id="badge'+data['code']+'" class="badge badge-red p-2"> New </span>';
    }
    html += '</div>';
    $('#usersChatList').prepend(html);
}
function check_box_update(){
    setInterval(function (){
        $('.usersChatList').each(function() {
            var currentElement = $(this);
            var code = currentElement.data('code');
            var id = currentElement.attr('id');
            var alert = '<span id="badge'+code+'" class="badge badge-red p-2"> New </span>';
            $.ajax({
                url: "?api=adminChat&a=checkChat&code="+code,
                type: "GET",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result){
                        $('#'+id + ' .badge-red').remove();
                        $('#'+id).append(alert);
                        $('#usersChatList'+id).prependTo('#chatMainBox');
                    }
                },
                error: function (xhr, status, error) {
                    console.log('resError:');
                    console.log(xhr);
                }
            });
        });
    },8000);
}
check_box_update();

function append_chats(data){
    let target = $('#chatMainBox');
    switch (data['user_type']){
        case 'admin':
        case 'consultant':
            switch (data['message_type']){
                case 'text':
                    target.append('<p class="admin-chat-box d-inline-block">'+data['message']+'</p>');
                    break;
                case 'image':
                    target.append('<a href="'+data['path']+'" target="_blank"><img src="'+data['path']+'" data-path="'+data['path']+'" class="admin-chat-img shadow" width="200"></a>');
                    break;
            }
            break;
        case 'user':
            switch (data['message_type']){
                case 'text':
                    target.append('<p class="user-chat-box d-inline-block">'+data['message']+'</p>');
                    break;
                case 'image':
                    target.append('<a href="'+data['path']+'" target="_blank"><img src="'+data['path']+'" data-path="'+data['path']+'" class="user-chat-img shadow" width="200"></a>');
                    break;
            }
            break
    }
}
function append_image(result){
    target.append('<a href="'+result.path+'" target="_blank"><img src="'+result.path+'" data-path="'+result.path+'" class="admin-chat-img shadow" width="200"></a>');
}
function append_text(result){
    let userMessage = '<div class="admin-chat-box text-right mr-4 mt-2 ">'+result.message+'</div>';
    target.append(userMessage);
}
// Send Message and Show to User