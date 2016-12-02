<?php

namespace admin\models;

use core;

defined('ACC')||exit('ACC Denied');


class user extends core\models{

    public $table = 'user';


    public function infoall($arr='',$num=0){
    	$arr1=array();
    	if (isset($arr['name'])) {$arr1['name']=array('like'=>'%'.$arr['name'].'%');}
    	if (isset($arr['phone'])) {$arr1['phone']=$arr['phone'];}
    	if (isset($arr['type'])) {$arr1['type']=$arr['type'];}

        $a=$this
        ->field('id,name,face,phone,sex,type,im,create_time,is_authen')
        ->where($arr1)
        ->page($arr['page'],$arr['pagesize'])
        ->fetchSql(0)
        ->select($num);

        return $a;

    }

}
?>