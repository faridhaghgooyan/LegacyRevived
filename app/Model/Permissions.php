<?php
namespace App\Model;
use App\Model\User;
class Permissions{
    public function checkPermission($roll,$controller,$action){
        $access = false;
        $users_obj = new users();
        // Variable Functions
        $function = $users_obj->findRoll($roll)['title'];
        // Check Permissions as Key & Value
        $keys = array_keys($this->$function());
        $values = array_values($this->$function()[$controller]);
        // Check for Controller & Action Permissions
        if (in_array($controller,$keys)){
            if (in_array($action,$values)){
                $access = true;
            } else {
                $access = false;
            }
        } else {
            $access = false;
        }
        return $access;
    }
    private function admin(){
        $permissions = array(
            "index" => array("index"),
            "supporter" => array(
                "add",
                "list",
                "invoicesList",
            ),
            "services" => array(
                "add",
                "list",
                "create",
                "read",
                "update",
                "services_list",
                "delete"
            ),
            "admin" => array(
                "create",
                "edit",
                "read",
                "update",
                "delete",
                "add",
                "list",
                "admin_check_number",
            ),
            "users" => array(
                "read",
                "userDelete",
                "userUpdate",
                "find",
                "admins",
                "cities",
                "store",
                "adminlist",
                "status",
                "logout",
                "addEfile",
                "userEfile",
                "createEfile",
                "getUserDetails",
                "getUserDetails",
            ),
            "chat" => array(
                "addToConsultant",
                "addToSupporter",
            ),
            "sms" => array(
                "add",
                "create",
                "list",
                "read",
                "update",
                "delete",
                "sendSMS",
            ),
            "drafts" => array(
                "add",
                "create",
                "list",
                "read",
                "update",
                "delete",
            ),
        "adminChat" => array(
                "chatsList",
                "store",
                "services_list",
                "findUser",
            ),
            "todo" => array(
                "todoList",

            ),


        );
        return $permissions;
    }
    private function site_admin(){
        $permissions = array(
            "index" => array("index"),
            "supporter" => array(
                "add",
                "list",
                "invoicesList",
            ),
            "notes" => array(
                "add",
                "create",
                "delete",
                "list",
                "store",
                "read",
                "edit",
                "update",
            ),

            "services" => array(
                "add",
                "list",
                "create",
                "read",
                "update",
                "services_list",
                "delete"
            ),
            "users" => array(
                "read",
                "addUser",
                "list",
                "userDelete",
                "userUpdate",
                "find",
                "cities",
                "store",
                "status",
                "logout",
                "addEfile",
//                "userEfile",
                "createEfile",
                "getUserDetails",
                "getUserDetails",
                "update_chat",
            ),
            "chat" => array(
                "addToConsultant",
                "addToSupporter",
                "update",
                "has_seen",
            ),

            "adminChat" => array(
                "chatsList",
                "store",
                "services_list",
                "findUser",
                "get_last_chats",
                "loop",
                "my_chat_list",
                "has_show",
                "loadMessages",
                "storeMessage",
                "update_chat",
                "get_city",
                "checkMobile",
                "new_chats",
                "consultant_new_chats",
                "checkChat",
                "loadNote",
                "getNote",
            ),
            "todo" => array(
                "add",
                "create",
                "list",
                "delete",
                "newTodo",
                "todoShow",
                "archive",
                "edit",
                "done",
                "store",

            ),
            "notes" => array(
                "add",
                "create",
                "delete",
                "list",
                "store",
                "read",
                "edit",
                "getNote",
                "update",
            ),
            "api" => array(
                "adminChat",

            ),


        );
        return $permissions;
    }
    private function doctor(){
        $permissions = array(
            "index" => array("index"),
            "supporter1" => array("add","list"),
            "doctors" => array(
                "tasks_list",
                "old_tasks",
                "addComment"
            ),
            "tasks" => array(
                "dr_done",

            ),
            "users" => array(
                "userEfile",
                "getUserDetails",
                "galleries",
            ),
        );
        return $permissions;
    }
    private function consultant(){
        $permissions = array(
            "index" => array("index"),
            "adminChat" => array(
                "chatsList",
                "store"
            ),
            "gallery" => array(
                "index",
            ),
            "consultant" => array(
                "addSupporterJob",
                "storeSupporterJob",
                "supporterTasksList",
                "readTask",
                "deleteTask",
            ),
            "notes" => array(
                "add",
                "create",
                "delete",
                "list",
                "store",
                "read",
                "edit",
                "getNote",
                "update",
            ),
            "sms" => array(

                "sendSMS",
            ),
            "chat" => array(
                "addToSupporter",
                "update",
                "has_seen",
                "to_gallery",
                "user_efile",
            ),
            "users" => array(
                "find",
                "createInvoice",
                "read",
                "list",
                "userDelete",
                "addUser",
                "invoicesList",
                "deleteInvoice",
                "addEfile",
                "userEfile",
                "cities",
                "storeUser",
                "getUserDetails",
                "reviewed",
                "logout",
                "accept",
            ),
            "invoices" => array(
                "add",
                "create",
                "read",
                "update",
                "delete",
                "edit",
                "store",
                "ready",
                "done",
                "list",
            ),
            "adminChat" => array(
                "chatsList",
                "store",
                "services_list",
                "findUser",
                "get_last_chats",
                "loop",
                "my_chat_list",
                "has_show",
                "loadMessages",
                "storeMessage",
                "update_chat",
                "get_city",
                "checkMobile",
                "new_chats",
                "consultant_new_chats",
                "checkChat",
                "loadNote",
                "getNote",
            ),
            "todo" => array(
                "add",
                "create",
                "list",
                "delete",
                "newTodo",
                "todoShow",
                "archive",
                "edit",
                "done",
                "store",
            ),
            "supporter1" => array("add","list"),
            "doctors" => array(
                "tasks_list",
                "old_tasks",
                "addComment"

            ),

        );
        return $permissions;
    }
    private function nurse(){
        $permissions = array(
            "index" => array("index"),
            "nurses" => array(
                "tasks_list",
                "old_tasks",
                "addComment"
            ),
            "users" => array(
                "supporterComment",
                "getUserDetails"


            ),
            "tasks" => array(
                "operatorComment",

            ),
        );
        return $permissions;
    }
    private function supporter(){
        $permissions = array(
            "index" => array("index"),
            "supporter" => array(
                "addDrTask",
                "addNurseTask",
                "tasksList",
                "readTask",
                "updateTask",
                "deleteTask",
                "createInvoice",
                "invoicesList",
                "deleteInvoice",
                "create",
            ),
            "users" => array(
                "getComment",
                "userEfile",
                "getUserDetails",
                "invoicesList",
            ),
            "todo" => array(
                "add",
                "create",
                "list",
                "delete",
                "newTodo",
                "todoShow",
                "archive",
                "edit",
                "done",
            ),
            "tasks" => array(
                "nurse_add",
                "nurse_create",
                "dr_add",
                "dr_create",
                "list",
                "delete",
            ),
            "services" => array(
                "doneServiceReq",
            ),
        );
        return $permissions;
    }
    private function finance(){
        $permissions = array(
            "index" => array("index"),
            "finance" => array(
                "invoicesList",
                "unpaidInvoices",
                "oldInvoices",
                "changeStatus",
                "acceptedPayments",
                "newPayments"
            ),
            "invoices" => array(
                "clear"
            ),
            "users" => array(
                "rejectPayment",
                "acceptPayment",
            ),
        );
        return $permissions;
    }
    private function customer(){
        $permissions = array(
            "index" => array("index"),
            "users" => array(
                "login",
                "editPassword",
                "loginByCode",
                "logout",
                "orderList",
                "idPay",
                "pay",
                "tasksList",
                "doneTasks",
                "unpaidInvoices",
                "doneInvoices",
                "readProfile",
                "changeProfile",
                "readPass",
                "changePass",
                "service_req",
                "rules",
                "showService",
                "chatsList",
                "store",
                "services_list",
                "findUser",
                "get_last_chats",
                "loop",
                "my_chat_list",
                "has_show",
                "loadMessages",
                "storeMessage",
                "update_chat",
                "get_city",
                "checkMobile",
                "new_chats",
                "checkChat",

    ),
            "ticket" => array(
                "storeTicket",
                "ticketsList",
                "read",
            ),
            "invoices" => array(
                "idPay",
                "idPay_callback",
                "idPay_verify",
                "withFish",
            ),
            "chat" => array(
                "store",
                "createChat",
                "user_seen",
                "user_update",
            ),
            "api" => array(
                "store",
                "newTODO",
                "servies",
                "update_chat",
            ),
            "payments" => array(
                "callback",

            ),

        );
        return $permissions;
    }
    private function guest(){
        $permissions = array(
            "index" => array("index"),
            "users" => array(
                "update_chat",
                "loginByCode",
                "logout",
                "orderList",
                "idPay",
                "pay",
                "tasksList",
                "doneTasks",
                "unpaidInvoices",
                "doneInvoices",
                "readProfile",
                "changeProfile",
                "readPass",
                "changePass",
                "service_req",
                "rules",
                "showService",

    ),
            "chat" => array(
                "store",
                "user_update",
                "user_seen",


    ),

            "api" => array(
                "store",
                "newTODO",
                "servies",
            ),

        );
        return $permissions;
    }
    private function reception(){
        $permissions = array(
            "index" => array("index"),
            "supporter" => array(
                "addDrTask",
                "addNurseTask",
                "tasksList",
                "readTask",
                "updateTask",
                "deleteTask",
                "createInvoice",
                "invoicesList",
                "deleteInvoice",
                "create",
            ),
            "users" => array(
                "getComment",
                "userEfile",
                "getUserDetails",
                "invoicesList",
            ),

            "invoices" => array(
                "list",
                "delete",

            ),
            "todo" => array(
                "add",
                "create",
                "list",
                "delete",
                "newTodo",
                "todoShow",
                "archive",
                "edit",
                "done",
            ),
            "tasks" => array(
                "nurse_add",
                "nurse_create",
                "dr_add",
                "dr_create",
                "dr_edit",
                "dr_list",
                "nurse_list",
                "task_delete",
                "nurse_edit",
                "task_update",
                "cancelTask",

            ),
            "services" => array(
                "doneServiceReq",
                "service_cancel",
            ),
        );
        return $permissions;
    }

}
