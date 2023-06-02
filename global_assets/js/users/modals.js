function servicesReq(service_id){
    let modal = $('#servicesModal');
    var form = document.getElementById('servicesModalForm');
    var chat_code = document.getElementById('code');
    document.getElementById('service_chat_code').value = chat_code.value
    $('#service_id_input').val(service_id);
    form.setAttribute('action',`?c=users&a=service_req&service_id=${service_id}`)
    modal.modal('show');
}