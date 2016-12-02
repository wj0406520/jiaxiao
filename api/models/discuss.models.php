<?php

/**
 * 帖子模版
 */


namespace api\models;

use core;

defined('ACC')||exit('ACC Denied');


class discuss extends core\models
{

    public $table = 'invitation';
    // 发帖
    public function postInvita($arr)
    {
    	// $
    	$arr['user_id'] = self::$user_id;

    	$arr['create_time'] = TIME;

    	$re = $this->checkAuthen($arr);

        $this->checkJurisdic($arr);

    	$arr['type'] = $re['type'];

    	$this->create($arr);

    	$arr=[];

    	$arr['invita_id'] = $this->insertId();

    	$arr['create_time'] = TIME;

        if(isset($_POST['img'])){
        	foreach ($_POST['img'] as $value) {
        		$img = DATA . $value;
        		if (is_file($img)) {
        			$arr['img_url'] = $value;
        			$this->table('invita_img')->create($arr);
        		}
        	}
        }

    	return true;
    }
    // 回复信息
    public function reply($arr)
    {

    	$this->checkInvita($arr);

    	$arr['create_time'] = TIME;

    	$arr['user_id'] = self::$user_id;

    	$this->table('reply')->create($arr);

        $array['id'] = $arr['invita_id'];

        $array['reply_time'] = TIME;

        $this->table('invitation')->create($array);

    	return true;
    }

    // 点赞
    public function like($arr)
    {

    	$this->checkInvita($arr);

    	$arr['user_id'] = self::$user_id;

    	$re = $this->table('like')->field('id,is_like')->where($arr)->getOne();

    	if ($re) {
    		$arr['id'] = $re['id'];
    		$arr['is_like'] = 1 - $re['is_like'];
    	} else {
    		$arr['is_like'] = 1;
    	}

    	$arr['create_time'] = TIME;

    	$this->create($arr);

    	return true;
    }
    // 帖子列表
    public function getList($arr)
    {

    	$arr['user_id'] = self::$user_id;

    	$this->checkJurisdic($arr);

        // ->join('invita_img', 'ii')
        // ->joinLink('i.id=ii.invita_id')
        // ii.img_url,

        $re=$this->getInvita($arr);

        foreach ($re as $key => $value) {
        	$where = ['invita_id'=>$value['invita_id']];
        	$arr = $this->table('invita_img')->field('img_url')->where($where)->select();

        	$re[$key]['like_num'] = $this->table('like')->where($where)->count();

        	$re[$key]['reply_num'] = $this->table('reply')->where($where)->count();

        	if ($arr) {
	        	$arr = array_column($arr, 'img_url');

	        	$re[$key]['img'] = $arr;
        	} else {
        		$re[$key]['img'] =[];
        	}
        }

        return $re;
    }

    // 帖子信息
    public function info($arr)
    {
    	$arr['user_id'] = self::$user_id;
        $page=$arr['page'];
        $pagesize=$arr['pagesize'];
    	$re = $this->checkInvita($arr);

    	$arr['type'] = $re['type'];

    	$this->checkJurisdic($arr);

        $re=$this->getInvita($arr,1);

    	$where = ['invita_id'=>$arr['invita_id']];

    	$arr = $this->table('invita_img')->field('img_url')->where($where)->select();

    	if ($arr) {
        	$arr = array_column($arr, 'img_url');

        	$re['img'] = $arr;
    	} else {
    		$re['img'] =[];
    	}

        $re['reply_num'] = $this->table('reply')->where($where)->count();

    	$arr = $this
    	->table('reply')
        ->alias('r')
        ->join('user','u')
        ->joinLink('u.id=r.user_id')
    	->joinField('r.content,r.create_time,u.name,u.face')
    	->where('r.invita_id = '.$where['invita_id'])
    	->joinOrder('r.create_time asc')
        ->page($page,$pagesize)
    	->select();

    	$re['reply'] = $arr ? $arr : [];

    	return $re;
    }

    // 回复列表
    public function replyList($arr)
    {

    	$re = $this->checkInvita($arr);

    	$where = ['invita_id'=>$arr['invita_id']];

        $arr = $this
        ->table('reply')
        ->alias('r')
        ->join('user','u')
        ->joinLink('u.id=r.user_id')
        ->joinField('r.content,r.create_time,u.name,u.face')
        ->where('r.invita_id = '.$arr['invita_id'])
        ->joinOrder('r.create_time asc')
        ->page($arr['page'],$arr['pagesize'])
        ->select();
    	return $arr;
    }


    // 获取帖子
    public function getInvita($arr,$type=0)
    {

    	$str = 'i.type = ' . $arr['type'];
    	if ($type != 0) {
    		$str .= ' and i.id='.$arr['invita_id'];
    	}

        $re=$this
        ->table('invitation')
        ->alias('i')
        ->join('user','u')
        ->joinLink('u.id=i.user_id')
        ->joinField('i.id as invita_id,i.title,i.content,i.create_time,u.name,u.face')
        ->where($str);

        if($type == 0){
        	$re = $this
	        ->page($arr['page'],$arr['pagesize'])
	        ->order('reply_time desc,create_time desc')
	        ->select();
        }else{
        	$re = $this->getOne();
        }

        return $re;
    }


    // 检测用户类型
    public function checkJurisdic($arr)
    {

    	$user = new core\models();

    	$re = $user->table('user')->find($arr['user_id']);

    	if($arr['type'] != 4 && $re['type'] != $arr['type']) {
    		$this->errorMsg('jurisdic');
    	}
    }

    //检测是否有帖子
    public function checkInvita($arr)
    {
    	$re=$this->find($arr['invita_id']);

    	if (!$re) {
    		$this->errorMsg('invitaMiss');
    	}
    	return $re;
    }
    //检测是否认证
    public function checkAuthen($arr)
    {

        $user = new core\models();

        $re = $user->table('user')->find($arr['user_id']);

        if ($re['is_authen'] == 0 && $arr['type'] == 1 ) {
            $this->errorMsg('authen');
        }

        return $re;
    }
}
?>