<?php

/**
 * 分组模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class group extends core\models
{

    public $table = 'group';

    public function addGroup($arr)
    {
        $this->checkGroupExits($arr);

        $arr['type'] = 1;

        $arr['user_id'] = self::$user_id;

        $arr['create_time'] = TIME;

        $this->create($arr);

    }

    public function getList()
    {
        $arr['user_id']=self::$user_id;
        $arr['is_delete']=0;
        $array['type']=0;
        $re=$this
        ->joinField('id as group_id,name as group_name')
        ->where($arr)
        ->where($array,'OR')
        ->select();

        return $re;
    }

    public function deleteGroup($arr)
    {
        $array['id']=$arr['group_id'];

        $re=$this->checkGroupMiss($array);

        if($re['type']==0){
            $this->errorMsg('groupSystem');
        }
        $array['is_delete']=1;
        $this->create($array);
    }


    public function createGroup($arr)
    {
        $array['id']=$arr['group_id'];

        $re=$this->checkGroupMiss($array);

        if($re['type']==0){
            $this->errorMsg('groupError');
        }
        if($re['user_id']!=self::$user_id){
            $this->errorMsg('groupError');
        }

        if($re['is_delete']==1){
            $this->errorMsg('groupError');
        }
        $array['name']=$arr['name'];

        $this->create($array);
    }

    public function listGroup()
    {
        $user_id=self::$user_id;
        $re=$this
        ->table('group')
        ->joinField('id as group_id,name as group_name')
        ->where('user_id='.$user_id.' or type=0')
        ->fetchSql(0)
        ->select();

        foreach ($re as $key => $value) {
            $re[$key]['friends']=$this
            ->table('friendship')
            ->alias('f')
            ->join('user','u')
            ->joinLink('f.friends_id=u.id')
            ->joinField('f.friends_id,u.name,u.face,u.im')
            ->where('f.group_id='.$value['group_id'] .' and f.is_delete=0 and f.user_id='.$user_id)
            ->select();
        }

        return $re;
    }

    public function checkGroupMiss($arr)
    {
        $re=$this->where($arr)->getOne();
        if(!$re){
            $this->errorMsg('groupNull');
        }
        return $re;
    }

    public function checkGroupExits($arr)
    {

    	$re=$this->where($arr)->getOne();

    	if($re){
    		$this->errorMsg('groupExits');
    	}

    }

}
?>