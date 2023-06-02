// Prepare for Send Data
let userType = $('#user_type').val();
let controller = 'chat';
var target = $('#chatMainBox');

$('.messageInput').on('keypress', function (e) {
    let message = $(this).val();
    if (e.which === 13 && message.length > 0) {
        e.preventDefault();
        send_data();
    }
});
$('.messageBtn').on('click', function (e) {
    let message = $('.messageInput').val();
    if (message.length > 1) {
        send_data();
    }
});
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
// check Chat Box selected or not
function check_select(code)
{
    // alert('check_select code :'+code);
    let result = false;
    if ($('#usersChatList'+code).hasClass('active')){
        result = true;
    }
    return result;
}
// Attach a New Badge in Boxes
function add_bage(user_id)
{
    let code = $('#chat_code').val();
    let target = $('#usersChatList'+user_id);
    if ($('#badge'+code).length == 0){
        target.removeClass('badge-red').append('<span id="badge'+code+'" class="badge badge-red p-2"> New </span>');
    }
    // console.log(target);
}
function remove_badge(divID)
{
    $('#'+divID+' .badge-red').remove();
}
function has_seen(id)
{
    $.ajax({
       url : "?api=chat&a=has_seen&id="+id,
       type : "get",
       dataType : "json",
       success : function (result){
           console.log(result)
       } ,
        error : function (xhr){
           console.log(xhr)
        }
    });
}
function user_seen(id)
{

    $.ajax({
        url : "/user/index.php?api=chat&a=user_seen&id="+id,
        type : "get",
        dataType : "json",
        success : function (result){
            console.log(result)
        } ,
        error : function (xhr){
            console.log(xhr)
        }
    });
}

