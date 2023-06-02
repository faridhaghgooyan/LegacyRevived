function update_chat(){
    setInterval(function (){
        $.ajax({
            url: "/user/index.php?api=users&a=update_chat&code="+code+"&rowID="+rowID,
            type: "GET",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                console.log(result);
                if (result.length > 0){
                    for (let i in result){
                        append_chats(result[i]);
                        scroller();
                    }
                }
            },
            error: function (xhr, status, error) {
                console.log('update_chat Error :');
                console.log(xhr);
            }
        });
    },3000)
}
update_chat()

// Append Data
function append_image(result){
    switch (result['user_type']){
        case 'consultant':
        case 'admin':
            target.append('<div class="text-left"><a href="'+result.path+'" target="_blank"><img src="'+result.path+'" data-path="'+result.path+'" class="user-chat-img shadow d-inline-block" width="200"></a></div>');
            break;
        case 'user':
            target.append('<div class="text-right"><a href="'+result.path+'" target="_blank"><img src="'+result.path+'" data-path="'+result.path+'" class="user-chat-img shadow d-inline-block" width="200"></a></div>');
            break;
    }


}
function append_text(result){
    console.log(result['message']);
    let userMessage = '';
    switch (result['user_type']){
        case 'consultant':
        case 'admin':
            userMessage = '<div class="text-left"><p class=" admin-chat-box d-inline-block">'+result['message']+'</p></div>';
            break;
        case 'user':
            let time =
            userMessage = '<div class="user-chat-box text-right mr-4 mt-2 ">';
            userMessage += result['message'];
            userMessage += '<br><p class="text-muted">'+result['created_at']+'</p></div>';
            break;
    }
    target.append(userMessage);
}