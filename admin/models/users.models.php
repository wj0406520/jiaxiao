<?php

namespace admin\models;

use core;

defined('ACC')||exit('ACC Denied');


class users extends core\models{

    public $table = 'admin';

    //验证登录信息
    public function verify_login($data){
        $a=$this->field('user_id')->where($data)->getOne();
        return $a;

    }
    //更新字段
    public function update_fields($data){
    	$res=$this->save($data);
    	return $res;
    }

}
?>