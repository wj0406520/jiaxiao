<?php

/**
 * 登录模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');

class login extends core\models
{

    public $table = 'user';

    public function checkPsw($phone, $psw)
    {
        $arr = [
                'password' => md5($psw),
                'phone' => $phone
            ];
        $re = $this->field('id,type,im')->where($arr)->fetchsql(0)->getOne();
        return $re;
    }

    public function checkUser($phone)
    {
        $arr = [
                'phone' => $phone
            ];

        $re = $this->field('id')->where($arr)->fetchsql(0)->getOne();
        return $re['id'];
    }

}
?>