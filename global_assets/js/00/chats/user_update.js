// Load New Chats
let chat_code = $('#code').val();
let admin_id = $('#admin_id').val();
function update() {
    setInterval(function (){
        $.ajax({
            url: "/user/index.php?api=chat&a=user_update&code="+chat_code,
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
                        switch (result[i]['message_type']){
                            case 'text':
                                append_text(result[i]);
                                user_seen(result[i]['id']);
                                scroller()
                                break;
                            case 'image':
                                append_image(result[i]);
                                user_seen(result[i]['id']);
                                scroller()
                                break;
                            case 'button' :
                                user_seen(result[i]['id']);
                                scroller()

                                break;
                        }
                    }
                }


            },
            error: function (xhr, status, error) {
                console.log('update() :');
                console.log(xhr);
            }
        });
    },5000)

}
update();

function append_image(result){
    target.append('<a href="'+result.path+'" target="_blank"><img src="'+result.path+'" data-path="'+result.path+'" class="admin-chat-img shadow" width="200"></a>');

}
function append_text(result){
    let roll = 'user';
    if (result['user_type'] == 'site_admin' || result['user_type'] == 'consultant'){
        roll = 'admin';
    }
    $('#chatMainBox').append('<div class="'+roll+'-chat-box text-right mr-4 mt-2 ">'+result.message+'<br>'+result.fa_time+'</div>');
}
// Send Message and Show to User