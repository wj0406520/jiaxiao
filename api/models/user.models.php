<?php

/**
 * 用户模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class user extends core\models
{

    public $table = 'user';

    public function getInfo()
    {

        $re=$this->field('name,face,personality,sex,is_authen,push')->fetchsql(0)->find(self::$user_id);

        return $re;
    }


    public function friendsList($arr)
    {
        if(is_array($arr)){
            $where=implode(',',$arr);
        }else{
            $where=$arr;
        }
    	$re=$this
    	->joinField('id as friends_id,name,im,face,personality')
    	->where(['im'=>['in'=>$where]])
    	->select();
    	return $re;
    }

    public function changePsw($arr)
    {
    	$re = $this
    	->field('password')
    	->find(self::$user_id);

    	if(md5($arr['ordpsw'])!=$re['password']){
    		$this->errorMsg('passwordError');
    	}
    	$array['password']=md5($arr['password']);
    	$array['id']=self::$user_id;
    	$this->create($array);
    	return true;
    }

}
?>