<?php
namespace App\Model;
class Main{
    public function __construct(){
        global $db;
        $this->db = $db;
    }
    public function ticketsCount(){
        $query = $this->db->query('select * from tickets where status=0');
        $result = $query->fetchAll();
        $count = count($result);
        return $count;
    }
    public function month_list(){
        $month = array(
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند'
        );
        return $month;
    }
}