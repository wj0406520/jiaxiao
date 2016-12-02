<?php

namespace api\controls;

use core;

defined('ACC')||exit('ACC Denied');


class user extends all
{


	//获取用户信息
	public function infoAction()
	{

		$a = $this->models->getInfo();

		$this->success($a);

	}

	//更新用户信息
	public function updateAction()
	{

		$check = $this->checkSearch([
				'sex'=>'',
				'name'=>'',
				'personality'=>'',
				'face'=>'',
				'push'=>''
			]);

		// $face=\tool\UploadTool::connect('face');
		// if($face===true){
		// 	$face='';
		// }elseif($face===false){
		// 	$this->errorMsg(\tool\UploadTool::$error);
		// }else{
		// 	$check['face']=$face;
		// }
		if($check){
			$check['id'] = \core\Models::$user_id;
			$this->models->create($check);
		}

		$this->success();
	}

	//意见反馈
	public function feedbackAction()
	{

		$check = $this->checkSearch([
				'msg'=>''
			]);
		$check['user_id'] = \core\Models::$user_id;
		$check['create_time'] = TIME;

		$this->models()->table('feed_back')->create($check);
		$this->success();
	}

	// 4.获取用户信息
	public function friendsAction()
	{
		$arr=$this->checkArrayId($_POST['im']);
		if(!$arr){
			$this->errorMsg('paramError');
		}
		$re=$this->models->friendsList($_POST['im']);
		$this->success($re);
	}


	// 修改密码
	public function changeAction()
	{
		$post = $this->validate([
              	'ordpsw' => ['password','length','6,16'],
              	'password' => ['password','length','6,16'],
			]);

		$this->models->changePsw($post);

		$this->success();
	}
}
?>