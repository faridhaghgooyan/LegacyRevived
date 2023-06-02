function append_image(result){
    switch (result['user_type']){
        case 'consultant':
        case 'admin':
            let html2 = "<div class='img-wrapper text-left'>";
            html2 += "<a href='"+result.path+"' target='_blank'>";
            html2 += "<img src='"+result.path+"' data-path='"+result.path+"' class='d-inline-block' width='200'>";
            html2 += "</a></div>";
            target.append(html2);
            break;
        case 'guest':
        case 'user':
            let html = "<div class='img-wrapper text-right'>";
            html += "<a href='"+result.path+"' target='_blank'>";
            html += "<img src='"+result.path+"' data-path='"+result.path+"' class='d-inline-block' width='200'>";
            html += "<span class='fa_time'>"+result.fa_time+"</span>";
            html += "</a></div>";
            target.append(html);
            break;
    }
}
function append_text(result){
    let userMessage = '';
    switch (result['user_type']){
        case 'consultant':
        case 'admin':
            userMessage = '<div class="text-left"><p class=" admin-chat-box d-inline-block">'+result['message']+'</p></div>';
            break;
        case 'user':
        case 'guest':
            let time =
                userMessage = '<div class="user-chat-box text-right mr-4 mt-2 ">';
            userMessage += result['message'];
            userMessage += '<br><p class="text-muted">'+result['fa_time']+'</p></div>';
            break;
    }
    target.append(userMessage);
}