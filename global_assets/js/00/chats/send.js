// Send Text
function send_data(){
    // Chat Variables
    // alert($('#chat_code').val())
    let formData = new FormData(document.querySelector('#chatForm'));
    $.ajax({
        url: "/user/index.php?api="+controller+"&a=store",
        type: "POST",
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            // console.log('send_data() Result :');
            // console.log(result);
            if (result){
                rowID = result['id'];
                append_text(result);
            }
            scroller();
            emptyInput();
        },
        error: function (xhr, status, error) {
            console.log('send_data() Error :');
            console.log(xhr);
        }
    });
}
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
        fd.append('owner_id',$('input[name=owner_id]').val());
        fd.append('token',$('input[name=token]').val());
    }
    $.ajax({
        url: "/user/index.php?api="+controller+"&a=store",
        type: "POST",
        dataType: 'json',
        data: fd,
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);
            if (result){
                rowID = result['id'];
                append_image(result);
            }
            scroller();
            emptyInput();
        },
        error: function (xhr, status, error) {
            console.log('send_file() Error :');
            console.log(xhr);
        }
    });
}
