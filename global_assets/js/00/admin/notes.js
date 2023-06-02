$('#notesForm').hide();
$('#note_text').on('keypress', function (e) {
    // if (e.which === 13) {
    //     e.preventDefault();
    //     send_note();
    // }
});
function send_note(){
    let code = $('#chat_code').val();
    let text = $('#note_text').val();
    let flag = '';
    // Chat Variables
    $.ajax({
        url: "?api=notes&a=store&chat_code="+code+"&text="+text,
        type: "GET",
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (result) {
            console.log(result);

            $('.notes-wrapper').append('<div class="note_box"><p>'+result['text']+'</p><p style="font-size: 1rem!important;">'+result["date"]+' /  '+result["time"]+'</p></div>');
            $('#note_text').val(' ');
            note_scroller();

        },
        error: function (xhr, status, error) {
            console.log('Note Form send_data() Error :');
            console.log(xhr);
        }
    });
}
function note_scroller(){
    let element = document.getElementById('notes-wrapper');
    element.scrollTop = element.scrollHeight;
}

