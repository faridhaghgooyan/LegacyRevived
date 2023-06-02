var admin_id = document.getElementById('admin_id');
var customersWrapper = document.getElementById('customersWrapper');
var user_offset = 0;
var note_offset = 0;
var note_input = document.getElementById('note_input');
var notes_area = document.getElementById('notes_area');
var chat_form_controllers = document.querySelectorAll('.chat_form_controllers');
var noteWrapper = document.getElementById('note_wrapper');
var roll_title = document.getElementById('roll_title');

//Customer Data
var customer_img = document.getElementById('customer_img')
var customer_fullname = document.getElementById('customer_fullname')
var customer_register_date = document.getElementById('customer_register_date')
// Initial preparation
document.addEventListener("DOMContentLoaded", function(){

});
// Check Select Code
function check_code_selected(){
    if (code.value == ''){
        chat_form_controllers.forEach(function (value,index){
            value.style.display = "none";
        })
        notes_area.style.display = 'none';
    }
}
check_code_selected()
// Load Admin Customers
async function my_customers(){
    var body = new FormData()
    body.append("action", "my_customers")
    body.append("offset", user_offset)
    body.append("admin_id",admin_id.value )
    body.append("roll_title",roll_title.value )
    let status = await makeRequest(`../app/controllers/api/chat_api.php`, "POST", body)
    console.log(status)
    if (status.error){
        sweet_alert('warning','توجه',status.error);
    }
    if (status.length > 0){
        user_offset += status.length
        for (const x in status){
            append_customers(status[x])
        }
        var btn = document.createElement("button");
        btn.setAttribute("class","more-customer d-block mx-auto")
        btn.setAttribute("onclick","my_customers()")
        btn.innerText = "بیشتر..."
        customersWrapper.append(btn)
    }
    // console.log(status);

    // if (!status.error){
    //
    // }
}
my_customers()
function todo_create(chat_code){
    plugins.todo.showModal(chat_code);
}
function invoice_create(chat_code){
    plugins.invoice.showModal(chat_code);
}
// Append Customers to The List
function append_customers(customer){
    if (customer.lastName == null){
        customer.lastName = "ناشناس"
    }
    if (customer.pic == null){
        customer.lastName = "ناشناس"
    }
    var checked = '';
    if (customer.checked == 0){
        checked = `
           <abbr title="تایید بررسی این زیباجو">
               <a class="" href="?c=users&a=accept&id=${customer.id}">
                    <i style="color: red!important;" class="fa fa-check"></i>
                </a>
            </abbr>
            `;
    }
    // Todo Btn

    var todoBtn = document.createElement('button')
    todoBtn.innerHTML = '<i class="fas fa-bell"></i>'
    todoBtn.setAttribute('onclick',`todo_create(${customer.chat_code})`)
    todoBtn.setAttribute('class',`mini-btns`)
    // Invoice Btn
    var invoiceBtn = document.createElement('button')
    invoiceBtn.innerHTML = '<i class="fas fa-file-invoice-dollar"></i>'
    invoiceBtn.setAttribute('onclick',`invoice_create(${customer.chat_code})`)
    invoiceBtn.setAttribute('class',`mini-btns`)




    customersWrapper.innerHTML += `
    <div  class="customer-box" data-chat-code="${customer.chat_code}" onclick="change_chat_code(${customer.chat_code},event)">
        <div>
            <img src="${customer.pic}" class="customer-box--img" width="40">
            <span>${customer.lastName}</span>
        </div>
        <div id="customerBoxActions${customer.chat_code}">
        
           
            ${checked}
        </div>
        
    </div> `
    // console.log(customer)
    var customerBox = document.getElementById(`customerBoxActions${customer.chat_code}`);

    customerBox.prepend(todoBtn)
    customerBox.prepend(invoiceBtn)
    // document.getElementById('testArea').prepend(testbtn)
}

// Change Chat Code For Admin
function change_chat_code(new_code,event){
    code.value = new_code;
    chatWrapper.innerHTML = '';
    chatWrapper.classList.remove('chatWrapper');
    chat_form_controllers.forEach(function (value,index){
        value.style.display = "block";
    })
    notes_area.style.display = 'block';
    get_old_chat();
    noteWrapper.innerHTML = '';
    customer_img.setAttribute('src','')
    customer_fullname.innerText = ''
    customer_register_date.innerText = ''
    plugins.notes.offset = 0
    if (welcome_message.value != 'site_admin'){
        plugins.notes.load()
    }
}
// Search on Customers List
function find_customer(event){
    var input = event.target;
    var customers = document.querySelectorAll('.customer-box');

    if (input.value.length > 3){
        customers.forEach(function (value,index){
            if (!value.innerText.match(input.value)){
                value.style.display = "none";
            }
        });
    }
    if (input.value == ''){
        customers.forEach(function (value,index){
            value.style.display = "block";
        });
    }
}
// Note Actions
note_input.onkeypress = function (event){
    if (event.keyCode == 13){
        plugins.notes.create();
    }
}
document.querySelector('.note_input_btn').addEventListener("click",function (){
    plugins.notes.create();
})
// Run Notes

// Run Selected Chat
setTimeout(function (){
    let chatBoxes = document.querySelectorAll('.customer-box')
    let selectedChat = localStorage.getItem('selectedChat')
    if (selectedChat){

        chatBoxes.forEach(function (value){
            console.log(value.getAttribute('data-chat-code'))
            if (value.getAttribute('data-chat-code') == selectedChat){
                value.style.borderColor = 'RED';
                value.click();
                localStorage.setItem('selectedChat','')
            }
        })
    }

},1000)