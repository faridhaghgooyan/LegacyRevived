// Move Data for add to Gallery
// function img_options(code,url){
//     let command = $(this).attr('command');
//     success_alert(command)
// }
$('body').on('click','.gallery',function (){
    let element = $(this);
    let status = $(this).data('status');
    let chat_id = $(this).data('chat_id');
    $.ajax({
        url: "?api=chat&a=to_gallery&id="+chat_id+"&status="+status,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);
            if (result){
                $('#addGallery'+result).remove();
                success_alert('با موفقیت انجام گردید');
            }

        },
        error: function (xhr, status, error) {
            console.log('Add to Gallery() Error :');
            console.log(xhr);
        }
    });

})