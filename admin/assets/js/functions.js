function modals(){
    this.show = function (message){
        sweet_alert('info','توضیحات',message);
    }
    this.addComment = async function (event,task_id) {
        event.preventDefault();
        console.log('hi')
        const { value: text } = await Swal.fire({
            input: 'textarea',
            inputLabel: 'ثبت نظر و تایید انجام کار',
            inputPlaceholder: 'توضیحات خود را بنویسید',
            inputAttributes: {
                'aria-label': 'Type your message here'
            },
            showCancelButton: true
        })
        if (text) {
            // Send Data
            var body = new FormData()
            body.append("action", "add_task_comment")
            body.append("comment", text)
            body.append("id", task_id)
            let status = await makeRequest(`../app/controllers/api/task_api.php`, "POST", body)
            console.log(status)

            if (status){
                location.reload();
            } else {
                sweet_alert('error','خطا',status.error);
            }
        }


    }
}
var modals = new modals();