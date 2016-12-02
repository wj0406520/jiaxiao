<?php

namespace admin\models;

use core;

defined('ACC')||exit('ACC Denied');


class invitation extends core\models{

    public $table = 'invitation';

    //根据用户名查询用户id
    public function uid($arr){
        $tb=new core\models;

        $u_id=$tb->table('user')->field('id')->where($arr)->select(0);
        return $u_id;
    }


    public function infoall($arr='',$num=0){
        $arr1=array();
        $u_id="";
    	$name=$arr['name']?array('name'=>array('like'=>'%'.$arr['name'].'%')):'';
    	$type=($arr['type']!=0)?'i.type='.($arr['type']):'';
        if ($name) {
          $uid=$this->uid($name);
          if ($uid) {
            foreach ($uid as $key => $val) {
                $user_id[]=$val['id'];
            }
            $u_id=implode(',',$user_id);
            $arr1=array('user_id'=>array("in"=>$u_id));
          }else{
            return false;
          }
          
        }

        
        $a=$this
        ->alias('i')
        ->join('user','u','LEFT')
        ->joinLink('i.user_id=u.id')
        ->joinField('u.name,i.id,title,i.type,i.create_time')
        ->where($type)
        ->where($arr1)
        ->page($arr['page'],$arr['pagesize'])
        ->fetchSql(0)
        ->select($num);

        return $a;

    }

    //帖子图片详情
    public function invita_img($id){
        $tb=new core\models;
        $img=$tb->table('invita_img')->field('img_url')->where($id)->select();
        return $img;
    }
    //帖子详情    
    public function invita_info($arr){
        $id=($arr['id'])?'i.id='.($arr['id']):'';
        $invita_id=($arr['id'])?'invita_id='.($arr['id']):'';
        $info=$this
        ->alias('i')
        ->join('user','u','LEFT')
        ->joinLink('i.user_id=u.id')
        ->joinField('u.name,i.id,title,i.type,i.create_time,content')
        ->where($id)
        ->fetchSql(0)
        ->getOne();
        $img=$this->invita_img($invita_id);
        $info["img"]=$img;
        return $info;

    }

}
?>