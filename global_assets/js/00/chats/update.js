// Load New Chats
let admin_id = $('#admin_id').val();
function update_chat_list_olddddddddddddd() {
    setInterval(function (){
        $.ajax({
            url: "?api=adminChat&a=new_chats",
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                // console.log(result);
                if (result.length > 0){
                    for (let i in result){
                        console.log('result[i]');
                        console.log(result[i]);
                        // check box exit
                        if ($('#usersChatList'+result[i]['id']).length == 0 && result[i]){
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
function update() {
    setInterval(function (){
        $.ajax({
            url: "?api=chat&a=update",
            type: "GET",
            dataType: 'json',
            data : {
                'admin_id' : admin_id
            },
            processData: false,
            contentType: false,
            success: function (result) {
                console.log('update(): Result :');
                console.log(result);
                if (result.length > 0){
                    for (let i in result){
                        if (result[i]['code']){
                            // console.log(result[i]['code'])
                            if ($('#usersChatList'+result[i]['code']).length == 0) {
                                append_chatBox(result[i]);
                            }
                            // check Chat Box selected or not
                            if (check_select(result[i]['code'])){
                                append_chats(result[i]);
                                has_seen(result[i]['id']);
                                remove_badge(result[i]['code']);
                                scroller();
                            } else {
                                add_bage(result[i]['code']);

                            }

                        } else {

                        }

                        let box = $('#usersChatList'+result[i]['id']);
                        // console.log(result[i]['code']);

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
update();
// Get User Chat
function loadMessages(code,divID){
    // $('input[name=code]').val(code);
    $('#chat_code').val(code);
    let lastRow = 0;
    $.ajax({
        url: "?api=adminChat&a=loadMessages&code="+code,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (result) {
            // Load Note
            // console.log('loadMessages() Result :');
            // console.log(result);
            get_note(code);
            $('#notesForm').show();


            remove_badge(divID);
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
                // $('#badge'+code).text('');
                scroller();
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
function get_note(code){
    // alert(code)
    $.ajax({
        url: "?api=notes&a=getNote&chat_code="+code,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (result) {
            console.log('get_notes() Result :');
            console.log(result);
            if (result.length > 0){
                $('#notesForm').show(300);
                $('.notes-wrapper').empty();
                for (let i in result){
                    if (result[i]['text']){
                        let data = '<div class="note_box"><p>'+result[i]['text']+'</p><p style="font-size: 1rem!important;">'+result[i]["fa_date"]+' /  '+result[i]["fa_time"]+'</p></div>'
                        $('.notes-wrapper').append(data);
                    }

                }
                note_scroller();
            }


        },
        error: function (xhr, status, error) {
            console.log('Note Form send_data() Error :');
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

    let html = '<div id="usersChatList'+data['code']+'" class="usersChatList" data-code="'+data['code']+'" onclick=loadMessages("'+data['code']+'","usersChatList'+data['code']+'")>';
    html += '<img src="/storage/noimage.jpg" alt="" width="50">';
    html += '<span>'+data['lastName']+'</span>';

    // html += '<abbr title="اختصاص به مشاور"><a class="" ><i onclick=consultantModal("'+data['code']+'") class="fa fa-mail-forward"></i></a></abbr>';
    if (data['owner_id'] != null ){
        html += '<abbr title="صدور فاکتور"><a class="" ><i onclick=factorModal("'+data['code']+'") class="fa fa-dollar"></i></a></abbr>';
        html += '<abbr title="ایجاد یادآور برای این چت"><a class="" ><i onclick=addTODO("'+data['user_id']+'","'+data['code']+'") class="fa ion-ios-alarm"></i></a></abbr>';
    }
    if (data['user_check'] != 1 && data['has_seend'] == 0){
        html += '<span id="badge'+data['code']+'" class="badge badge-red p-2"> New </span>';
    }
    html += '</div>';
    $('#usersChatList').prepend(html);
    add_bage(data['user_id']);
}
// function check_box_update(){
//     setInterval(function (){
//         $('.usersChatList').each(function() {
//             var currentElement = $(this);
//             var code = currentElement.data('code');
//             var id = currentElement.attr('id');
//             var alert = '<span id="badge'+code+'" class="badge badge-red p-2"> New </span>';
//             $.ajax({
//                 url: "?api=adminChat&a=checkChat&code="+code,
//                 type: "GET",
//                 dataType: 'json',
//                 processData: false,
//                 contentType: false,
//                 success: function (result) {
//                     if (result){
//                         $('#'+id + ' .badge-red').remove();
//                         $('#'+id).append(alert);
//                         $('#usersChatList'+id).prependTo('#chatMainBox');
//                     }
//                 },
//                 error: function (xhr, status, error) {
//                     console.log('resError:');
//                     console.log(xhr);
//                 }
//             });
//         });
//     },8000);
// }
// check_box_update();

function append_chats(data){
    console.log(data);
    let target = $('#chatMainBox');
    switch (data['user_type']){
        case 'site_admin':
        case 'consultant':

            switch (data['message_type']){
                case 'text':
                    target.append('<p class="admin-chat-box d-inline-block">'+data['message']+'<br><span class="datatime">'+data['fa_date']+' '+data['fa_time']+'</span></p>');
                    break;
                case 'image':
                    target.append('<a  href="'+data['path']+'" target="_blank"><img src="'+data['path']+'" data-path="'+data['path']+'" class="admin-chat-img shadow" width="300">'+data['fa_time']+'<br></a>');
                    break;
            }
            break;
        case 'user':
        case 'guest':

            switch (data['message_type']){
                case 'text':
                    target.append('<p class="user-chat-box d-inline-block">'+data['message']+'<br><span class="datatime">'+data['fa_date']+' '+data['fa_time']+'</span></p>');
                    break;
                case 'image':
                    let btn = '';
                    if (data['owner_id'] != 0){
                        let event = 0;
                        let title = 'حذف';
                        let myclass = ' remove_gallery ';
                        if (data['add_gallery'] == 0){
                            event = 1;
                            title='افزودن';
                            myclass = ' add_gallery ';
                        }
                        btn = '<span id="addGallery'+data['id']+'" class="gallery '+myclass+'" data-chat_id="'+data['id']+'" data-path="'+data['path']+'" data-status="'+event+'">'+title+'</span>';
                    }
                    target.append('<a target="_blank">'+btn+'<img src="'+data['path']+'" data-path="'+data['path']+'" class="user-chat-img shadow" width="300"></a>');
                    break;
            }
            break
    }
}
function append_image(result){
    $('#chatMainBox').append('<a href="'+result.path+'" target="_blank"><img src="'+result.path+'" data-path="'+result.path+'" class="admin-chat-img shadow" width="200"></a>');
}
function append_text(result){
    let userMessage = '<div class="admin-chat-box text-right mr-4 mt-2 ">'+result.message+'<br><span class="datatime">'+result.fa_time+' '+result.fa_date+'</span></div>';
    $('#chatMainBox').append(userMessage);
}
// Send Message and Show to User

// Select a Box
function select_box(){
    let url = window.location.href;
    let spl = url.split('#');
    if (spl[1]){
        let target = spl[1];
        $('#'+target).click();
    }
}
select_box();