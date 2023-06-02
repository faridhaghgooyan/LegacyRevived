function findChat($filename){

    let file = '../../chat_history/'+$filename;
    $.get(file).done(function(result) {
        for (let i in result){
            if (result[i].type == 'user'){
                $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+result[i].text+'</div>');
            } else if (result[i].type == 'admin'){
                $('#chatarea').append('<div class="admin-chat-box text-right">'+result[i].text+'</div>');
            }
        }

    }).fail(function() {
        $('#chatarea').append('<div class="admin-chat-box text-right">به دلیل مشکلات فنی ، این فایل یافت نشد</div>');
    })
    $('#chatModal').modal('show');
    // var n = $('#chatModal').height();
    // $('html, #chatarea').animate({ scrollTop: n }, 50);

}
function drModal(id,doctor){

    if (doctor){
        $('select[name="doctors_list"] option[value="'+doctor+'"]').prop('selected', true);
    } else {
        $('select[name="doctors_list"] option[value="default"]').prop('selected', true);
    }

    $("#formData").empty();
    $('#formData').append('<input type="hidden" name="chat_id" value="'+id+'">');
    $('#doctorsModal').modal('show');
}
// // Check if User Reload Page withou loosing data
// let reload = $('.admin-chat-box').length;
// if (reload <= 1){
//     Swal.fire({
//         title: '<strong>کاربر گرامی </strong>',
//         icon: 'success',
//         html:
//             'ظاهرا دسترسی شما موقتا قطع شده بود ، اما سوابق چت شما را فقط برای امروز نگه داشتیم.',
//         showCloseButton: true,
//         showCancelButton: true,
//         focusConfirm: false,
//         confirmButtonText:
//             '<i class="fa fa-thumbs-up bg-light"></i> باشه!',
//         confirmButtonAriaLabel: 'Thumbs up, great!',
//         cancelButtonText:
//             '<i class=""></i>',
//         cancelButtonAriaLabel: ''
//     })
//     let mac = "<?php echo $mac ?>";
//     let date = "<?php echo date('Y-m-d') ?>";
//     let data = "<?php echo '../chat_history/'.$mac.date('Y-m-d').'.json' ?>";
//
//     window.setInterval(function (){
//         $.get(data).done(function(result) {
//             for (let i in result){
//                 if (result[i].mac_address == mac && result[i].timestamp == date ){
//                     if (result[i].type == 'user'){
//                         $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+result[i].text+'</div>');
//                     } else if (result[i].type == 'admin'){
//                         $('#chatarea').append('<div class="admin-chat-box text-right">'+result[i].text+'</div>');
//                     }
//                     var n = $('#chatarea').height();
//                     $('html, #chatarea').animate({ scrollTop: n }, 50);
//                 }
//             }
//         }).fail(function() {
//             // alert('Not Found');
//         })
//     },2000);
// }
//
// $('#usersubmit').on('click',function (e){
//     let message = $('#usermessage').val();
//     e.preventDefault();
//     $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+message+'</div>');
//
// })
// $('#adminsubmit').on('click',function (e){
//     let message = $('#adminmessage').val();
//     e.preventDefault();
//     $('#chatarea').append('<div class="admin-chat-box text-right">'+message+'</div>');
//     message.val("");
//     // alert(message);
// });
// Create Chat
function userCreate () {
    // Chat Variables
    let formData = new FormData(document.querySelector('#userForm'));
    // Send Data to PHP Script
    $.ajax({
        url:"?c=chat&a=store",    //the page containing php script
        type: "POST",    //request type,
        dataType: 'json',
        data: formData ,
        processData: false,
        contentType: false,
        success:function(result){
            console.log('result');
            console.log(result);
        },
        error : function(xhr, status, error){
            console.log('resError:');
            console.log(xhr.responseText);

        }
    });
    let message = $('#usermessage').val();
    $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+message+'</div>');

}
function adminCreate() {
    // Chat Variables
    let formData = new FormData(document.querySelector('#adminForm'));
    // console.log('formData');
    // Send Data to PHP Script
    $.ajax({
        url:"../?c=chat&a=store",    //the page containing php script
        type: "POST",    //request type,
        dataType: 'json',
        data: formData ,
        processData: false,
        contentType: false,
        success:function(result){
            console.log('result');
            console.log(result);
        },
        error : function(xhr, status, error){
            console.log('resError:');
            console.log(xhr.responseText);

        }
    });
    // let message = $('#usermessage').val();
    // $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+message+'</div>');
    window.setInterval(function (){
        console.log('Loop');
        $.get(data).done(function(newResult) {
            let id = (newResult.length)-1;
            if (flag < newResult.length){
                if (newResult[id].type == 'user'){
                    $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2 here">'+newResult[id].text+'</div>');
                    let x = document.getElementById("myAudio");
                    x.play();
                    var container = $('#chatarea'),
                        scrollTo = $('.here');

                    container.animate({
                        scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
                    });
                }
                if (newResult[id].type == 'admin'){
                    $('#chatarea').append('<div class="admin-chat-box text-right mr-4 mt-2 here">'+newResult[id].text+'</div>');
                    let x = document.getElementById("myAudio");
                    x.play();
                    var container = $('#chatarea'),
                        scrollTo = $('.here');

                    container.animate({
                        scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
                    });
                }

                flag = newResult.length;
                console.log('YES');
                console.log(flag);
            }
        })
        // console.log(new_flag++);
    },1000);
}
$('.user-chat-img').on('click',function (){
    let src = $(this).attr('src');
    $('#chatModal .modal-body').append('<a href="#"><img src="'+src+'" class="img-fluid shadow"></a>');
    $("#chatModal").modal('show');

})
function create_backup () {
    // let mac_address = $('#userForm input[name="mac_address"]').val();
    // let chat_code = $('#userForm input[name="chat_code"]').val();
    // let text = $('#userForm input[name="text"]').val();
    // let type = $('#userForm input[name="type"]').val();
    // // let chatfile = $('input[name="chatfile"]')[0].files[0]);
    // var formData = new FormData();
    // // formData.append('mac_address', $('#userForm input[name="mac_address"]').val();
    // // formData.append('chat_code', $('#userForm input[name="chat_code"]').val();
    // // formData.append('text', $('#userForm input[name="text"]').val();
    // // formData.append('type', $('#userForm input[name="type"]').val();
    // // formData.append('chatfile', $('input[name="chatfile"]')[0].files[0]);
    // formData.append(
    //     'mac_address' : mac_address
    // );


    let formData = {
        mac_address : $('#userForm input[name="mac_address"]').val(),
        chat_code : $('#userForm input[name="chat_code"]').val(),
        text : $('#userForm input[name="text"]').val(),
        type : $('#userForm input[name="type"]').val(),
    };
    console.log(formData);
    $.ajax({
        url:"?c=chat&a=store",    //the page containing php script
        type: "POST",    //request type,
        dataType: 'json',
        data: formData ,
        processData: false,
        contentType: false,
        success:function(result){
            console.log('result');
            console.log(result);
        },
        error : function(xhr, status, error){
            console.log('resError:');
            console.log(xhr.responseText);

        }
    });
    let message = $('#usermessage').val();
    $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2">'+message+'</div>');

}
function showChat(filename){
    // $('#chatarea').empty();
    let data = '/chat_history/'+filename;
    // let file_name = $(this).attr('data-chat');
    // $('#userForm input[name="admin_file_name"]').val(file_name);
    $.get(data).done(function(result) {
        let old_flag = result.length;
        let new_flag = old_flag;
        for (let i in result){
            if (result[i].type == 'user'){
                $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2 ">'+result[i].text+'</div>');
                console.log(result[i].fileType);

                // Check Chat Format
                if (result[i].fileType == 'image/jpg'){
                    $('#chatarea').append('<img src="/'+result[i].filePath+'" data-path="'+result[i].filePath+'" class="user-chat-img shadow" width="150">');
                }
                if (result[i].fileType == 'audio/wav') {
                    $('#chatarea').append('<audio controls><source src="/' + result[i].filePath + '" data-path="' + result[i].filePath + '" type="audio/ogg"></audio>');
                }
            }
            if (result[i].type == 'admin'){
                $('#chatarea').append('<div class="admin-chat-box text-right ">'+result[i].text+'</div>');
            }

        };

        // setInterval for chat update
        let flag = 0;
        window.setInterval(function (){
            console.log('Loop');
            $.get(data).done(function(newResult) {
                let id = (newResult.length)-1;
                if (flag < newResult.length){
                    if (newResult[id].type == 'user'){
                        $('#chatarea').append('<div class="user-chat-box text-right mr-4 mt-2 here">'+newResult[id].text+'</div>');
                        let x = document.getElementById("myAudio");
                        x.play();
                        var container = $('#chatarea'),
                            scrollTo = $('.here');

                        container.animate({
                            scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
                        });
                    }
                    if (newResult[id].type == 'admin'){
                        $('#chatarea').append('<div class="admin-chat-box text-right mr-4 mt-2 here">'+newResult[id].text+'</div>');
                        let x = document.getElementById("myAudio");
                        x.play();
                        var container = $('#chatarea'),
                            scrollTo = $('.here');

                        container.animate({
                            scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
                        });
                    }

                    flag = newResult.length;
                    console.log('YES');
                    console.log(flag);
                }
            })
            // console.log(new_flag++);
        },1000);
    }).fail(function() {
        // alert('Not Found');
    })
}


// Chat Functions
    // User Create Chat
$('#usermessage').on('keypress',function (e){
    let message = $(this).val();
    if (e.keyCode === 13) {
        e.preventDefault();
        alert(message);
    }

})
function createChat(e){
    alert(e.which)
}