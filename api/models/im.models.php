<?php

/**
 * 用户模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class im extends core\models
{


    public function changeNickname($arr)
    {

        $conf = $this->getConf();
        $msg['nickname']=$arr['name'];

        $http=new \tool\HttpTool();
        $url=$conf->hxurl.$conf->hxuname.'/'.$conf->hxapp.'/users/'.$arr['im'];
        $header=[
            'Authorization:Bearer YWMtOlCXIqsAEeaCfRuXsWhVCQAAAAAAAAAAAAAAAAAAAAE5pqDwqwAR5qQD2XcA0R_4AgMAAAFYZsMk2ABPGgCNvr4Zy7IRgnV96fU3xwpE-Ywr7rHNrRdvGu4vh6BacA'
        ];

        $a=$http->put($url,$msg,$header);

        return true;
    }


    public function registerIm($arr)
    {

        $conf = $this->getConf();
        $msg['username']=date('YmdHis').$arr['id'];
        $msg['password']='123456';
        $msg['nickname']=$arr['nickname'];

        $http=new \tool\HttpTool();
        $url=$conf->hxurl.$conf->hxuname.'/'.$conf->hxapp.'/users';

        $a=$http->post($url,json_encode($msg));

        return $msg['username'];
    }
}
?>