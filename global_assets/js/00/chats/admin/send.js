// Check for Command

$('.messageInput').on('keypress', function (e) {
    let message = $(this).val();
    if (e.which === 13 && message.length > 0) {
        send_data();
    }
});
$('.messageBtn').on('click', function (e) {
    let message = $('.messageInput').val();

    if (message.length > 1) {
        send_data();
    }

});

// Send File
function send_file(){
    // Chat Variables
    var fd = new FormData();
    var files = $('#chatfile')[0].files;
    console.log(scroll);
    if (files.length > 0){
        fd.append('file',files[0]);
        fd.append('code',$('input[name=code]').val());
        fd.append('message_type','image');
        fd.append('user_type',$('input[name=user_type]').val());
        fd.append('token',$('input[name=token]').val());
    }
    $.ajax({
        url: "/admin/index.php?api=adminChat&a=storeMessage",
        type: "POST",
        dataType: 'json',
        data: fd,
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);
            if (result){
                append_image(result);
            }

            scroller();
            emptyInput();
        },
        error: function (xhr, status, error) {
            console.log('resError:');
            console.log(xhr);
        }
    });
}
// Send Text
function send_data(){
    // Chat Variables
    let formData = new FormData(document.querySelector('#adminChatForm'));
    $.ajax({
        url: "/admin/index.php?api=adminChat&a=storeMessage",
        type: "POST",
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);
            if (result){
                append_text(result);
            }
            scroller();
            emptyInput();
        },
        error: function (xhr, status, error) {
            console.log('resError:');
            console.log(xhr);
        }
    });
}