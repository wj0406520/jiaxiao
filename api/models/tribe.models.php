<?php

/**
 * 部落模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class tribe extends core\models
{

    public $table = 'tribe';

    // 部落编号
    public function number()
    {
    	while (true) {
    		$arr['number'] = mt_rand('111111111','999999999');
    		$re = $this->checkNumber($arr);
    		if(!$re){
    			break;
    		}
    	}
    	return $arr;
    }
    // 新增部落
    public function addTribe($arr)
    {

    	$array['number']=$arr['number'];
    	$re=$this->checkNumber($array);
    	if($re){
    		$this->errorMsg('tribeExits');
    	}
    	$arr['create_time']=TIME;
    	$arr['user_id']=self::$user_id;
    	$this->create($arr);
    	return true;
    }
    // 部落列表
    public function tribeList($arr)
    {
        $where=implode(',',$arr);

        $re=$this
        ->joinField('id as tribe_id,name,face,number')
        ->where(['im'=>['in'=>$where]])
        ->select();
        return $re;
    }

    public function deleteTribe($arr)
    {
        $array['user_id']=self::$user_id;
        $array['id']=$arr['tribe_id'];
        $this->where($array)->save(['delete_time'=>TIME,'is_delete'=>'1']);
        return true;
    }

    public function checkNumber($arr)
    {
        $arr['is_delete']=0;
    	$re=$this->where($arr)->getOne();
    	return $re;
    }
}
?>

