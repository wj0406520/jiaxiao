<?php

/**
 * 好友模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class friends extends core\models
{

    public $table = 'user';

    public function search($arr)
    {

    	$re = $this
    	->joinField('id as friends_id,name,face,sex')
    	->where(['name'=>['like' =>$arr['search']],'phone' =>$arr['search']],'OR')
    	->where(['id' => ['noin' => self::$user_id]])
    	->fetchsql(0)
    	->select();

        return $re;
    }

    public function userInfo($arr)
    {
        $arr['user_id']=self::$user_id;
        $re=$this->checkFrends($arr);
        $array['friendship']=$re;
        $re=$this
        ->table('user')
        ->joinField('id as friends_id,name,face,sex,personality,phone')
        ->find($arr['friends_id']);
        if(!$array){
        	$this->errorMsg('usermiss');
        }
        $re=array_merge($re,$array);
        return $re;
    }

    public function addFrinds($arr)
    {
        $array['user_id']=self::$user_id;
        $array['friends_id']=$arr['friends_id'];
        if($array['user_id']==$array['friends_id']){
            $this->errorMsg('selfError');
        }
        $re=$this->checkFrends($array);
        if($re==1){
            $this->errorMsg('friendExits');
        }
        $a = new group();
        $re=$a->checkGroupMiss(['id'=>$arr['group_id']]);
        if($re['type']!=0 && $re['user_id']!=$array['user_id']){
            $this->errorMsg('groupNull');
        }

        $re=$this->checkAdd($array);
        $array=array_merge($array,$arr);
        $array['create_time']=TIME;
        $array['state']=0;

        $this->table('add_friends')->create($array);

    }

    public function friendsList()
    {
        $user_id=self::$user_id;
        $re=$this
        ->table('add_friends')
        ->alias('a')
        ->join('user','u')
        ->joinLink('a.user_id=u.id')
        ->joinField('a.id as add_id,u.name,u.face,a.state,a.create_time')
        ->where('a.state!=3 and a.friends_id='.$user_id)
        ->joinOrder('a.create_time desc')
        ->select();
        return $re;
    }

    public function sureFriends($arr)
    {
        $arr['user_id']=self::$user_id;

        $a = new group();
        $re=$a->checkGroupMiss(['id'=>$arr['group_id']]);
        if($re['type']!=0 && $re['user_id']!=$arr['user_id']){
            $this->errorMsg('groupNull');
        }


        $array['id']=$arr['add_id'];
        $array['friends_id']=$arr['user_id'];
        $re=$this->checkSure($array);

        $this
        ->table('add_friends')
        ->where($array)
        ->save(['state'=>1]);

        unset($arr['add_id']);
        $arr['friends_id']=$re['user_id'];
        $arr['create_time']=TIME;

        $this->table('friendship')->create($arr);

        $arr['user_id']=$re['user_id'];
        $arr['friends_id']=$re['friends_id'];
        $arr['remarks']=$re['remarks'];
        $arr['group_id']=$re['group_id'];

        $this->table('friendship')->create($arr);

        return true;
    }

    public function refuseFriends($arr)
    {
        $arr['user_id']=self::$user_id;
        $array['id']=$arr['add_id'];
        $array['friends_id']=$arr['user_id'];
        $re=$this->checkSure($array);
        $this
        ->table('add_friends')
        ->where($array)
        ->save(['state'=>2]);
        return true;
    }

    public function deleteFriends($arr)
    {
        $arr['user_id']=self::$user_id;
        $a=$this->checkFrends($arr);
        if(!$a){
            return true;
        }

        $array['is_delete']=1;
        $array['delete_time']=TIME;
        $array['delete_user']=self::$user_id;
        $this->chFriends($arr,$array);
        $a=$arr['user_id'];
        $arr['user_id']=$arr['friends_id'];
        $arr['friends_id']=$a;
        $this->chFriends($arr,$array);

    }

    public function chFriends($where,$save)
    {
        $this
        ->table('friendship')
        ->where($where)
        ->save($save);

        $this->table('add_friends')->where($where)->fetchSql(0)->save(['state'=>3]);

    }


    public function checkFrends($arr)
    {
    	$arr['is_delete']=0;

    	$re=$this->table('friendship')->where($arr)->getOne();

    	if($re){
    		return 1;
    	}
    	return 0;
    }

    public function checkSure($arr)
    {
        $re=$this->getAddFriends($arr);

        if(!$re){
            $this->errorMsg('addMsgError');
        }
        if($re['state']!=0){
            $this->errorMsg('checkSure');
        }
        return $re;
    }

    public function checkAdd($arr)
    {
        $re=$this->getAddFriends($arr);
        if($re){
            if($re['state']==0){
                $this->errorMsg('addFrinds');
            }elseif($re['state']==1){
                $this->errorMsg('friendExits');
            }
        }
        $array['user_id']=$arr['friends_id'];
        $array['friends_id']=$arr['user_id'];
        $re=$this->getAddFriends($array);
        if($re){
            $this->errorMsg('addMsg');
        }
    }
    public function getAddFriends($arr)
    {
        $re=$this->table('add_friends')->where($arr)->getOne();
        return $re;
    }
}
?>