// admin Controllers
function getUserDetails(id){
    alert(id);
    let moodal = $('#customerDetailsModal');
    let modalBody = $('#customerDetailsModal .modal-body');
    let customerName = $('#detailsUserName');
    modalBody.empty();
    $.ajax({
        url : '?api=users&a=getUserDetails&id='+id,
        method : 'get',
        dataType : 'json',
        success : function (result){
            if (!result){
                alert('no');
                modalBody.append('<i class="fa fa-sad-cry" style="display: block"></i><p>متاسفانه هنوز سابقه ای ثبت نشده است!</p>')
                moodal.modal('show');
            } else {
                moodal.modal('show');
            }
            console.log(result);
        } ,
        error : function (xhr ){
            console.log(xhr);
        }
    })
}

$('#forgetPasswordForm').hide();

function forget_password(){
    $('#loginForm').hide(300);
    $('#forgetPasswordForm').show(300);
}

function checkUniqueCode(){

    let uniqueCode = $('#uniqidCode').val();
    if (uniqueCode.length === 6) {
        $.ajax({
            url : '/user/index.php?api=users&a=checkResetCode',
            method : 'post',
            dataType: 'json',
            data : uniqueCode,
            success : function (result){
                console.log(result);

            },
            error : function (xhr){
                console.log(xhr);
            }
        })
    }
}
function changeToMan(){
    $('#forWomen').hide(200);
}
function changeToWomen(){
    $('#forWomen').show(200);

}