var admin_id = document.getElementById('admin_id');
var roll_title = document.getElementById('roll_title');
var customersWrapper = document.getElementById('customersWrapper');
var user_offset = 0;
// Load Admin Customers
async function my_customers(){
    var body = new FormData()
    body.append("action", "my_customers")
    body.append("offset", user_offset)
    body.append("admin_id",admin_id.value )
    body.append("roll_title",roll_title.value )
    let status = await makeRequest(`../api.php`, "POST", body)

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
    console.log(status);

    // if (!status.error){
    //
    // }
}
my_customers()

// Append Customers to The List
function append_customers(customer){
    customersWrapper.innerHTML += `<div class="customer-box" data-chat-code="${customer.code}" onclick="change_chat_code(${customer.code})"><div><span>${customer.lastName}</span><img src="${customer.pic}" className="customer-box--img" width="50"></div></div>
`
    console.log(customer)
}

// Change Chat Code For Admin
function change_chat_code(new_code){

    code.value = new_code;
}

