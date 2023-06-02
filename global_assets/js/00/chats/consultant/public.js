/*
* User Form Name = userChatForm
* User Form Chat Box Area = chatMainBox
* User Form Submit Button = userSubmit
* User Message = userMessage
* */
var target = $('#chatMainBox');
// if Page Refreshed
// $( document ).ready(function() {
//     $.ajax({
//         url: "?api=adminChat&a=has_show",
//         type: "GET",
//         dataType: 'json',
//         processData: false,
//         contentType: false,
//         success: function (result) {
//             console.log("Rested!!")
//         },
//         error: function (xhr, status, error) {
//             console.log('has_show Error :');
//             console.log(xhr);
//         }
//     });
// });
// Scroll To End
function scroller(){
    let element = document.getElementById('chatMainBox');
    element.scrollTop = element.scrollHeight;
}
// Empty User and Admin Message Input
function emptyInput(){
    $('#userMessage').val('');
    $('#adminMessage').val('');

}
/* Admin Functions */