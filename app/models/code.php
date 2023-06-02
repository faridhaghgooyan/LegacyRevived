<?php
require_once dirname(__DIR__, 3)."/config.php";

class Code{
    protected $code = 0;
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    function forget_password_code(){
        return rand(000000,999999);
    }

}