var plugins = {
    notes : {
        note_el : noteWrapper,
        offset : 0,
        chat_code : 0,
        customer_fullname : '',
        register_date : '',
        customer_img : '',
        create : async function (){
            const note = note_input.value;
            if (note.length  > 3){

                var body = new FormData()
                body.append("action", "create")
                body.append("chat_code", code.value)
                body.append("text", note_input.value)
                let status = await makeRequest(`../app/controllers/api/note_api.php`, "POST", body)
                if (!status.error){
                    this.append(status);
                } else {
                    sweet_alert('error','خطا',status.error);
                }
            } else {
            }

        },
        load : async function (){
            this.setChatCode();
            var body = new FormData()
            body.append("action", "list")
            body.append("offset", this.offset)
            body.append("chat_code", this.chat_code)
            let status = await makeRequest(`../app/controllers/api/note_api.php`, "POST", body)
            if (status.error){
                sweet_alert('warning','توجه',status.error);
            } else {
                this.customer_fullname = status[0]['lastName'] != null ? status[0]['firstName'] + ' ' + status[0]['lastName'] : 'ناشناس';
                this.register_date = status[0]['created_at']
                this.customer_img = status[0]['pic']
                this.customerData()
                for (const x in status){
                    this.prepend(status[x]);

                }
                console.log(status)
                // Increase Offset
                this.offset += status.length
                this.loadBtn();
            }
            console.log(status)
        },
        prepend : function (data){
            // Clear Notes Wrapper
            var div = document.createElement("div")
            div.setAttribute("class","note-box")
            div.innerText = data.text
            this.note_el.prepend(div)
            console.log(data)

        },
        append : function (data){
            // Clear Notes Wrapper
            var div = document.createElement("div")
            div.setAttribute("class","note-box")
            div.innerText = data.text
            // Empry Input
            this.empty()
            this.note_el.append(div)
            console.log(data)

        },
        empty : function (){
            note_input.value = ''
        },
        loadBtn : function (){
            var loadBtn = document.createElement('button')
            loadBtn.setAttribute('class','load_more_btn')
            loadBtn.innerText = "بیشتر..."
            loadBtn.onclick = function (){plugins.notes.load()}
            this.note_el.prepend(loadBtn)
        },
        setChatCode : function (){
            this.chat_code = code.value
        },
        customerData : function (){
            console.log(document.getElementById('customer_name'))
            customer_img.setAttribute('src',this.customer_img);
            customer_fullname.innerHTML = this.customer_fullname;
            customer_register_date.innerText = this.register_date;
        }
    },
    todo : {
        id : 0,
        chat_code : 0,
        customer_id : 0,
        todoModal : document.getElementById('todoModal'),
        showModal : function (chat_code){
            this.chat_code = chat_code
            $('#todoModal').modal('show')
            document.querySelector('.modal-body input[name=chat_code]').value = this.chat_code
            console.log(document.querySelector('.modal-body input[name=chat_code]').value)
        },
        hide : function (){
            this.todoModal.classList.remove('active');
        },
        update :  function (){
            setInterval(async function(){
                var body = new FormData()
                body.append("action", "new")
                body.append("admin_id", admin_id.value)
                let status = await makeRequest(`../app/controllers/api/todo_api.php`, "POST", body)
                console.log(status)
                if (!status.error && status.id){
                    var todo = status;
                    var content = document.getElementById('reminder-content');
                    var username = document.getElementById('customer_name');
                    var fa_date = document.getElementById('due_date');
                    var fa_time = document.getElementById('due_time');
                    var todo_done_btn = document.getElementById('todo_done_btn');
                    var todo_change_btn = document.getElementById('todo_change_btn');
                    // Modal Data
                    var fullname = todo.lastName ? todo.lastName : 'ناشناس'
                    username.innerText = fullname
                    fa_time.innerText = todo.fa_time
                    fa_date.innerText = todo.fa_date
                    content.innerText = todo.message
                    // Change BTN
                    todo_done_btn.setAttribute('href',`/admin/?c=todo&a=done&id=${todo.id}`)
                    todo_change_btn.setAttribute('href',`/admin/?c=todo&a=edit&id=${todo.id}`)
                    $('#reminderContentModal').modal('show')
                }
            },2000)
        },


    },
    invoice : {
        id : 0,
        chat_code : 0,
        customer_id : 0,
        showModal : function (chat_code){
            document.getElementById('invoice_chat_code').value = chat_code
            $('#addInvoice').modal('show')


            // $('#todoModal').modal('show')
        },
        hide : function (){
            this.todoModal.classList.remove('active');
        },
        update : function (){

        },


    },

}

// INIT
plugins.todo.update()