function addTODO(customer_id,file){

    let modal = $('#todoModal');
    modal.modal('show');
    $('input[name=customer_id]').val(customer_id);
    $('#todoForm').prepend('<input name="customer_id" type="hidden" value="'+customer_id+'" >');
    $('#todoForm').prepend('<input name="chat_files" type="hidden" value="'+file+'" >');

}
function smsModal(){
    let modal = $('#smsModal');
    modal.modal('show');
}
function reminderModal(message,file,user){
    let modal = $('#reminderModal');
    let userName = 'Nobody';
    modal.modal({
        show : 'true',
        backdrop : 'static',
        keyboard : false
    });
    $.ajax({
        url : '?api=users&a=find&id='+user,
        method : 'get',
        success : function (res){
            console.log('res');
            console.log(res);
        },
        error : function (xhr){
            console.log(xhr);
        }
    })
    $('#reminderModal .modal-body').append('<p>'+message+'</p>');
    $('#reminderModal .modal-body').append('<a class="btn btn-info" onclick=""><i class="fa fa-receipt"></i></a>');
}
function factorModal(code)
{
    let modal = $('#addInvoice');
    modal.modal('show');
    $('#addInvoice #createInvoice').prepend('<input name="code" type="hidden" value="'+code+'" >');
}
function getMessage(id)
{
    let modal = $('#commentModal');
    let message = $('#message'+id).val();
    if (id.length > 8){
        message = id;
    }
    modal.modal('show');
    $('#commentModal .modal-body').empty().prepend('<p class="">'+message+'</p>');
}
function get_percent()
{
    let target = $('#addInvoice .invoice_percent');
    let final_price = $('#addInvoice input[name=final_price]').val();
    let min_price = $('#addInvoice input[name=min_price]').val();
    let percent = Math.round( (min_price * 100) / final_price);
    target.empty();
    target.append(percent);
}
