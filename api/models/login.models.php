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

    public function registerIm($id)
    {

        $conf = core\conf::getIns();
        $msg['username']=date('YmdHis').$id;
        $msg['password']='123456';
        $http=new \tool\HttpTool();
        $url=$conf->hxurl.$conf->hxuname.'/'.$conf->hxapp.'/users';

        $a=$http->post($url,json_encode($msg));

        return $msg['username'];
    }
}
?>