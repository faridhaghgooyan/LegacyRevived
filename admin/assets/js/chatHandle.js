// Loading Chat List
function get_chat_list()
{
    alert('ger');
    $.ajax({
        url: "?api=adminChat&a=get_chat_list",
        type: "POST",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);

        },
        error: function (xhr, status, error) {
            console.log('resError:');
            console.log(xhr);
        }
    });

}
get_chat_list()
