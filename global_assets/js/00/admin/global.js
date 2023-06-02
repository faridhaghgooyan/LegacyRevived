function separate(Number)
{
    Number+= '';
    Number= Number.replace(',', '');
    x = Number.split('.');
    y = x[0];
    z= x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(y))
        y= y.replace(rgx, '$1' + ',' + '$2');
    return y+ z;
}
function check_number(field,user)
{
    let data = $('input[name='+field+']').val();
    let submit = $('#formSubmit');
    $.ajax({
        url: "/admin/index.php?api=admin&a=admin_check_number&phone="+data,
        dataType: 'json',

        processData: false,
        contentType: false,
        success: function (result) {
            if (result.length > 0){
                submit.hide();
                error_alert('این شماره همراه یا تلفن قبلا ثبت شده است!');
            } else {
                submit.show(300);

            }
        },
        error: function (xhr, status, error) {
            console.log('check_number() Error :');
            console.log(xhr);
        }
    });

}
$(document).ready(function() {

    $('textarea').keypress(function(event) {

        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });
});