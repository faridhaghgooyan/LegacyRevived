

function append_chats(data){
    let target = $('#chatMainBox');
    switch (data['user_type']){
        case 'admin':
        case 'consultant':
            switch (data['message_type']){
                case 'text':
                    target.append('<div class="text-left"><p class="admin-chat-box d-inline-block">'+data['message']+'</p></div>');
                    break;
                case 'image':
                    target.append('<div class="text-left"><a href="'+data['path']+'" target="_blank"><img src="'+data['path']+'" data-path="'+data['path']+'" class="admin-chat-img shadow" width="200"></a></div>');
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
