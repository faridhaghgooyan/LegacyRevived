<?php
require_once '../app/models/users.php';
$user = new users();
?>

<style>
    #chatMainBox{
        max-height: 350px;
        overflow: auto;
    }
    .fa{
        margin-right: 10px!important;
        margin-left: 5px!important;
        cursor: pointer;
    }
    .bg-whatsapp{
        min-height: 250px;
        max-height: 60vh;
        overflow: auto;
        background-image: url("../storage/chatbackground.jpg");
        background-repeat: repeat;
        background-size: 300px;
        border-radius: 10px 10px 0px 0px;
        padding: 10px;
    }
    .chat-controller{
        background-color: #2b2b2d;
        padding: 10px 5px;
        margin: 0 0px;
    }

    .calendar-month{

    }
    .calendar-month-title{
        text-align: center;
        border: 1px dashed lightgrey;
        border-radius: 5px;
        padding: 5px;
    }
    .calendar-content{
        display: flex;
        justify-content: start;
        align-items: center;
        width: 50%!important;

    }
    .calendar-day-2 {
        background-color: #eaeaea;
        width: 50px;
        height: 50px;
        text-align: center;
        margin: 5px!important;
        border-radius: 10px;
        line-height: 50px;
        transition: 0.5s;
    }
    .calendar-day{
        background-color: #eaeaea;
        width: 50px!important;
        height: 50px!important;
        text-align: center;
        margin: 5px!important;
        border-radius: 10px;
        line-height: 50px;
        transition: 0.5s;
        display: inline-block;
    }
    .calendar-day:hover{
        background-color: #d6d6d6;
        cursor: pointer;
    }
    .border-red{
        border: 1px solid red;
    }
    .border-blue{
        border: 1px solid #156acf;
    }
    .badges{
        font-size: 0.8rem;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        position: relative;
        top: -20px;
        right: -18px;
    }
    .badge-red{
        padding: 0px 8px;
        font-size: 1.2rem!important;
        background-color: red;
        color: wheat;
    }
    .badge-blue{
        background-color: #156acf;
        color: #156acf;
    }
    #adminChatForm #adminMessage{
        padding: 10px;
        border-radius: 20px;
        border: none;
    }
    .preMessage{
        background-color: lightgrey;
        padding: 5px;
        border-radius: 10px;
        margin: 10px 5px;
    }
    #usersChatList{
        max-height: 300px;
        padding: 10px;
        overflow: auto;
    }
    .usersChatList {
        padding: 5px;
        border: 1px solid #e3e3e3;
    }
    .usersChatList:hover{
        background: #e9e9e9;
        cursor: pointer;

    }
    .active{
        padding: 5px;
        background: #e9e9e9 !important;
    }
    .usersChatList img {
        border-radius: 50%;
        border: 1px solid lightgray;
        background: white;

    }
    .bg-white {
        background-color: white;
        padding: 10px;
    }
    .fa-mail-forward , .fa-users{
        margin-left: 5px;
        margin-right: 10px;
    }
    .d-flex {
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
    }
    .justify-content-between {
        -webkit-box-pack: justify !important;
        -ms-flex-pack: justify !important;
        justify-content: space-between !important;
    }
    .align-items-center {
        -webkit-box-align: center !important;
        -ms-flex-align: center !important;
        align-items: center !important;
    }
    .circle {
        height: 40px;
        width: 40px;
        padding: 10px 18px;
        background-color: #e7e7e7;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        color: #858585;
    }
    .circle:hover {
        background-color: tomato;
        color: white;
        cursor: pointer;
    }
    .circle-active {
        background-color: tomato;
        color: white;
        cursor: pointer;
    }
    .d-inline {
        display: inline !important;
    }
    .rtl{
        direction: rtl;
        text-align: right;
    }
    .d-none{display: none}
    .w-50{width: 50%;}

</style>
<?php //require '../app/view/admin/section/modals.php';?>
<script>
    let selectedChat = localStorage.getItem('selectedChat')
    console.log(selectedChat)
</script>
<?php
require_once "../app/view/admin/index/dashboards/$admin_info->roll_title.php";
?>


<audio id="myAudio">
    <source src="../storage/notif.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<audio id="myAudio2">
    <source src="../storage/adminnotif.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<!--<script src="../assets/js/kamadatepicker.min.js"></script>-->
<!--<script>-->
<!--    $("#elementId").persianDatepicker();-->
<!--</script>-->


<!--<script src="../assets/js/users.js"></script>-->
<!--<script src="../global_assets/js/adminChats.js"></script>-->

<!--<script>-->
<!--    newChats();-->
<!--</script>-->
<!---->
<!---->
<!--<script>-->
<!--    $("#elementId").persianDatepicker();-->
<!--</script>-->
<!--<script src="../assets/js/select2.min.js"></script>-->
<!--<script src="../assets/js/kamadatepicker.min.js"></script>-->
<!--<script src="http://localhost/assets/js/persianDatepicker.min.js"></script>-->
<!--<script>-->
<!--    kamaDatepicker('factor_due_date', {-->
<!--        forceFarsiDigits : false,-->
<!--        sync : true,-->
<!--        markToday : true,-->
<!--        markHolidays : true,-->
<!--        highlightSelectedDay : true,-->
<!--        twodigit : true,-->
<!--        buttonsColor: "red",-->
<!--        forceFarsiDigits: true,-->
<!--        gotoToday : true,-->
<!--    });-->
<!--    kamaDatepicker('todo_due_date', {-->
<!--        forceFarsiDigits : false,-->
<!--        sync : true,-->
<!--        markToday : true,-->
<!--        markHolidays : true,-->
<!--        highlightSelectedDay : true,-->
<!--        twodigit : true,-->
<!--        buttonsColor: "red",-->
<!--        forceFarsiDigits: true,-->
<!--        gotoToday : true,-->
<!--    });-->
<!--</script>-->
<!--<script src="../assets/js/kamadatepicker.min.js"></script>-->

<script>
    kamaDatepicker('due-date', {
        forceFarsiDigits : false,
        sync : true,
        markToday : true,
        markHolidays : true,
        highlightSelectedDay : true,
        twodigit : true,
        buttonsColor: "red",
        forceFarsiDigits: true,
        gotoToday : true,
    });
</script>