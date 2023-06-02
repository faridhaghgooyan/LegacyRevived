var target = $('#chatMainBox');
let rowID = 0;
let code = $('input[name=code]').val();
// Check for Command
if (checkMobile()){
    $('.messageInput').on('click', function (e) {


    });
}
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
function checkMobile(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        return true;
    }
}