async function makeRequest(url, method, body) {
    try {
        let response = await fetch(url, {
            method,
            body
        })
        // console.log(response)
        let result = await response.json();
        return result
    } catch(err) {
        console.error(err)
    }
}
function sweet_alert(type,title,message){
    Swal.fire({
        icon: type,
        title: title,
        text: message
    })
}
