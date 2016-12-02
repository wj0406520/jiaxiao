<?php

namespace admin\models;

use core;

defined('ACC')||exit('ACC Denied');


class feedBack extends core\models{

    public $table = 'feed_back';

   

    //查询反馈列表
    public function infoall($arr='',$num=0){
        
    	$type=($arr['type']!=0)?'u.type='.($arr['type']):'';
        $a=$this
        ->alias('f')
        ->join('user','u','LEFT')
        ->joinLink('f.user_id=u.id')
        ->joinField('u.name,u.type,f.id,f.create_time')
        ->where($type)
        ->joinOrder( 'f.create_time desc')
        ->page($arr['page'],$arr['pagesize'])
        ->fetchSql(0)
        ->select($num);

        return $a;

    }

   
    //帖子详情    
    public function feedBackinfo($arr){
        $id=($arr['id'])?'f.id='.($arr['id']):'';
        $info=$this
        ->alias('f')
        ->join('user','u','LEFT')
        ->joinLink('f.user_id=u.id')
        ->joinField('u.name,u.type,f.id,f.create_time,f.msg')
        ->where($id)
        ->fetchSql(0)
        ->getOne();
        
        return $info;

    }

}
?>