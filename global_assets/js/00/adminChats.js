






function stringToTimestamp(stringDate){
    let dateString = stringDate,
        dateTimeParts = dateString.split(' '),
        timeParts = dateTimeParts[1].split(':'),
        dateParts = dateTimeParts[0].split('-'),
        date;

    date = new Date(dateParts[2], parseInt(dateParts[1], 10) - 1, dateParts[0], timeParts[0], timeParts[1]);

    return date;
}

//Get New Chats
function newChats(){
    let flag = 0;

    setInterval(function (){
        $.ajax({
            url: "?api=adminChat&a=chatsList",    //the page containing php script
            type: "POST",    //request type,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (result) {
                console.log('result');
                console.log(result);
                let userID = result[0]['user_id'];
                if (result.length > flag){
                    for (let i in result){
                        let fileName = result[i][5];
                        let messageCount = 0;
                        // let userName = result[1]['user_name'];

                        console.log(userName);
                        $.getJSON('../chat_history/'+fileName,function (data){
                            messageCount = data.length;
                            $('#usersChatList').prepend('' +
                                '<div id="usersChatList'+i+'" class="usersChatList" onclick=loadMessages("'+fileName+'","usersChatList'+i+'")>' +
                                    '<img src="/storage/profile/profile01.png" alt="" width="50">' +
                                    '<span>'+result[i]["user_name"]+' </span>'+
                                    '<span class="badge badge-red p-2">'+messageCount+'</span>'+
                                    '<abbr title="اختصاص به مشاور"><a class="" ><i onclick=consultantModal("'+fileName+'") class="fa fa-mail-forward"></i></a></abbr>'+
                                '<abbr title="صدور فاکتور"><a class="" ><i onclick=factorModal("'+userID+'") class="fa fa-dollar"></i></a></abbr>'+
                                '<abbr title="ایجاد یادآور برای این چت"><a class="" ><i onclick=addTODO("'+userID+'","'+fileName+'") class="fa ion-ios-alarm"></i></a></abbr>'+
                                '</div>');
                        });


                    }
                }
                flag = result.length;
            },
            error: function (xhr, status, error) {
                console.log('resError:');
                console.log(xhr.responseText);

            }
        });
    },500)
}



function newServiceReq(){
    let table = $('#newServiceReq');
    table.empty();
    let count = $('#newServiceReq tr').length;
    $.ajax({
        url : '?api=adminChat&a=services_list',
        method : 'post',
        dataType : 'json',
        success : function (result){
            console.log('result');
            console.log(result);
                for (let i=0;i<result.length;i++){
                    table.append('<tr>' +
                        '<td>'+(count+1)+'</td>'+
                        '<td>'+getUserName(result[i]["customer_id"])+'</td>'+
                        '<td>'+result[i]["service_id"]+'</td>'+
                        '<td>' +
                        '<a class="btn"><i class="fa fa-comment"></i></a>' +
                        '<abbr title="'+result[i]["created_at"]+'" class="btn"><i class="fa fa-clock"></i></abbr>' +
                        '</td>'+
                        '</tr>')
                    count++;
                }

        },
        error : function (xhr){
            console.log(xhr);
        }
    })
    console.log('end');

}
function getUserName(id) {
    let userName;
    $.ajax({
        url : '?api=adminChat&a=findUser&id='+id,
        method : 'post',
        dataType : 'json',
        success : function (result){

            let firstname = result['firstName'];
            let lastname = result['lastName'];
            userName = firstname;
        },
        error : function (xhr){
            console.log(xhr);
        }
    })
    return userName;

}
function getServiceName(id){

}

// let name = getUserName(40);
