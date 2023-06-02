// Get History if page refrshed
function get_history(){
    // Chat Variables
    let formData = new FormData(document.querySelector('#userChatForm'));
    var target = $('#chatMainBox');
    $.ajax({
        url: "/user/index.php?api=users&a=getHistory",
        type: "POST",
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);
            if (result){
                for (let i in result){
                    switch (result[i]['message_type']){
                        case 'text':
                            console.log(result[i]);
                            append_text(result[i]);
                            break;
                        case 'image':
                            console.log(result[i]);
                            append_image(result[i]);
                            break;
                    }
                    scroller();

                }
            }

        },
        error: function (xhr, status, error) {
            console.log('get_history Error :');
            console.log(xhr);
        }
    });
    emptyInput();
}
get_history()