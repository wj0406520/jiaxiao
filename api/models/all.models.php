<?php


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class all extends core\Models
{


    public function checkToken($token)
    {
        $arr = [
                'token' => $token
            ];
        $re = $this->table('user')->field('id')->where($arr)->fetchsql(0)->getOne();

        return $re['id'];
    }

    public function checkUser($phone)
    {
        $arr = [
                'telphone' => $phone
            ];
        $re = $this->field('id')->where($arr)->fetchsql(0)->getOne();
        return $re['id'];
    }

}
?>