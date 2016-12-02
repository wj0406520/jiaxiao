<?php

/**
 * index模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class index extends core\models
{


    public function sendmsg($arr)
    {

        $a = $this
        ->table('phone_code')
        ->field('create_time')
        ->where(array('phone'=>$arr['phone'],'num'=>0))
        ->order('create_time desc')
        ->getOne();
        $time=$a['create_time']+60*30;

        if($a && $time>time()){
            $this->errorMsg('msgerror');
        }

        $conf = core\conf::getIns();

        $code = mt_rand(100000,999999);
        $msg['userid'] = '';
        $msg['account'] = $conf->account;
        $msg['password'] = $conf->password;
        $msg['mobile'] = $arr['phone'];
        $msg['content'] = $conf->contentleft.$code.$conf->contentright;
        $msg['sendTime'] = '';
        $msg['action'] = 'send';
        $msg['extno'] = '';
        $url = $conf->url;

        // $phone=$arr['phone'];

        $http = new \tool\HttpTool();
        $a  =$http->get($url,$msg);
        $a=json_decode($a,true);
        if($a['returnstatus']!='Success'){
            $this->errorMSG('msgapierror');
        }
        $arr['code'] = $code;
        $arr['create_time'] = time();
        $arr['num'] = 0;
        $a = $this
        ->table('phone_code')
        ->create($arr);
        return true;

    }

    public function checkphone($phone,$code)
    {

        $a=$this
        ->table('phone_code')
        ->field('id')
        ->where(array('phone'=>$phone,'num'=>0,'code'=>$code))
        ->getOne();
        $arr=$a;
        $arr['num']=1;
        if($a){
            $this
            ->create($arr);
            return true;
        }else{
            $this->errorMsg('phonecodeerror');
        }
    }



}
?>