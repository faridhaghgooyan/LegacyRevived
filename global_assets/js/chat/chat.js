// Global Variables
var chatWrapper = document.getElementById('chatWrapper');
var code = document.getElementById('code');
var user_id = document.getElementById('user_id');
var user_type = document.getElementById('user_type');
var target_user = document.getElementById('target_user');
var roll_title = document.getElementById('roll_title');
var offset = 0;
var message_input = document.getElementById('message');
var welcome_message = document.getElementById('welcome_message').remove();

// Get Data
async function get_new_chat(code , user_type ) {
    // Variables
    var body = new FormData()
    body.append("action", "get_new_chat")
    body.append("user_type", user_type)
    body.append("roll_title", roll_title.value)
    body.append("code", code)
    let status = await makeRequest(`../app/controllers/api/chat_api.php`, "POST", body)
    if (!status.error){
        for (const x in status){
            var message = status[x];
            switch (message.message_type){
                case "text":
                    append_text(message);
                    break;
                case "image":
                    append_image(message);
                    break;
                case "voice":
                    append_audio(message);
                    break;
                case "link":
                    console.log('message')
                    console.log(message)
                    append_link(message);
                    break;
            }
            // console.log(status[x])
        }
        // message.value = '';
        // append_text(status);
    }
    //console.log(status);
    // if (status === true){
    //     alert('Welcome to the ReflexMania Shop!');
    //     window.location.href = "../category.php";
    // }

}
// Get Old Data
async function get_old_chat(offset = 0) {
    // Variables
    var body = new FormData()
    body.append("action", "get_old_chat")
    body.append("user_type", user_type)
    body.append("code", code.value)
    body.append("offset", offset)
    if (code.value != ''){
        let status = await makeRequest(`../app/controllers/api/chat_api.php`, "POST", body)
        console.log(status)
        if (!status.error && status.length > 0){
            if (welcome_message){
                welcome_message.remove();
            }
            offset += status.length;
            var load_more = document.createElement("button");
            load_more.innerText = "بیشتر...";
            load_more.setAttribute("onclick",`get_old_chat(${offset})`);
            load_more.setAttribute("class",`load_more_btn`);
            for (const x in status){
                var message = status[x];
                switch (message.message_type){
                    case "text":
                        prepend_text(message);
                        break;
                    case "image":
                        prepend_image(message);
                        break;
                    case "voice":
                        prepend_audio(message);
                        break;
                    case "link":
                        console.log('message')
                        console.log(message)
                        append_link(message);
                        break;
                }
                // console.log(status[x])
            }
            chatWrapper.prepend(load_more);

        } else {

            sweet_alert('warning','توجه',status.error);
        }
    }
    // console.log(status);
}
get_old_chat()
// Scroll Down
function scroll_down(){
    var chatHeight = chatWrapper.scrollHeight;
    chatWrapper.scrollBy(0,chatHeight);
}
// Send Data
async function send_message() {
    // Variables
    var message = document.getElementById('message');
    var message_type = document.getElementById('message_type');
    var body = new FormData()
    body.append("action", "send")
    body.append("message",message.value )
    body.append("user_id", user_id.value)
    body.append("user_type", user_type.value)
    body.append("message_type", message_type.value)
    body.append("code", code.value)
    let status = await makeRequest(`../app/controllers/api/chat_api.php`, "POST", body)
    console.log(status);
    if (!status.error){
        message.value = '';
        switch (status.message_type){
            case 'text':
                append_text(status);
                break;

            case 'link':
                append_link(status);
                break;
        }


    }
    // console.log(status);
    // if (status === true){
    //     alert('Welcome to the ReflexMania Shop!');
    //     window.location.href = "../category.php";
    // }

}
async function send_image() {
    var message_type = document.getElementById('message_type');
    var input = document.querySelector('input[type="file"]')
    var file = input.files[0];
    var body = new FormData()
    body.append('action', 'send_image')
    body.append('file', file)
    body.append("user_id", user_id.value)
    body.append("user_type", user_type.value)
    body.append("code", code.value)
    body.append("message_type", "image")

    let status = await makeRequest(`../app/controllers/api/chat_api.php`, "POST", body)
    // console.log(status);

    if (!status.error){
        input.value = '';
        append_image(status);
    } else {
        sweet_alert('error','خطا',status.error);
        input.value = '';
    }

}
$('#chatForm').on('keydown', 'input', function(e) {
    if (e.keyCode === 13) {
        e.preventDefault();
        e.stopImmediatePropagation();
        send_message()
    }
});
// Append Data
function append_text(data){
    if (data.user_type == "user"){
        chatWrapper.innerHTML += `<div class="user-chat">${data.message}</div>`;
    } else {
        chatWrapper.innerHTML += `<div class="admin-chat">${data.message}</div>`;
    }
    scroll_down()
}
function append_image(data){
    // console.log(data)
    console.log(data)
    chatWrapper.innerHTML += `<img src="/storage/image/${data.path}" class="user-chat-img" >`;
    scroll_down()
}
function append_link(data){
    // console.log(data)
    console.log(data)
    chatWrapper.innerHTML += `<a href="${data.path}"  class="btn btn-danger text-right my-2 " style="display: block!important;width: 200px;margin-top: 10px 0 !important;">ورود به حساب کاربری</a>`;
    scroll_down()
}
function append_audio(data){
    // console.log(data)
    chatWrapper.innerHTML += `<audio controls><source src="../storage/voice/${data.path}" type="audio/ogg"></audio>`;
    scroll_down()

}
// Prepend Data
function prepend_text(data){
    if (data.user_type == "user"){
        var div = document.createElement("div");
        div.setAttribute("class","user-chat");
        div.innerText = `${data.message}`;
        chatWrapper.prepend(div) ;
    } else {
        var div = document.createElement("div");
        div.setAttribute("class","admin-chat");
        div.innerText = `${data.message}`;
        chatWrapper.prepend(div) ;
    }
    scroll_down()

}
function prepend_image(data){

    var img = document.createElement("img");
    img.setAttribute("class","user-chat-img");
    img.setAttribute("src",`/storage/image/${data.path}`);
    chatWrapper.prepend(img);
    scroll_down()

}
function prepend_audio(data){
    // console.log(data)
    var audio = document.createElement("audio");
    audio.setAttribute("controls",true);
    var source = document.createElement("source");
    source.setAttribute("src",`../storage/voice/${data.path}`);
    source.setAttribute("type","audio/ogg");
    audio.append(source);
    chatWrapper.prepend(audio);
    scroll_down()


}
// Update Data
setInterval(function (){
    get_new_chat( code.value, target_user.value );
},2000)