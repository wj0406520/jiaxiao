<?php

/**
 * 好友控制器
 */
namespace api\controls;

use core;

defined('ACC')||exit('ACC Denied');


class friends extends all
{


	//搜索用户
	public function searchAction()
	{

		$check = $this->fill([
				['search', '', 'string'],
			]);

		if(is_numeric($check['search'])){
			$check = $this->validate([
				'search' => ['phone', 'phone'],
			]);
		}

		$a = $this->models->search($check);

		$this->success($a);

	}

	// 好友详情
	public function userInfoAction()
	{
		$check = $this->fill([
				['friends_id', 0, 'int'],
			]);

		$a = $this->models->userInfo($check);

		$this->success($a);
	}
	// 添加好友
	public function addAction()
	{
		$check = $this->fill([
				['friends_id', 0, 'int'],
				['group_id', 0, 'int'],
				['remarks', '', 'string'],
			]);
		$this->models->addFrinds($check);
		$this->success();
	}
	// 添加好友列表
	public function listAction()
	{
		$re=$this->models->friendsList();
		$this->success($re);
	}
	//确认添加好友
	public function sureAction()
	{
		$check = $this->fill([
				['add_id', 0, 'int'],
				['group_id', 0, 'int'],
				['remarks', '', 'string'],
			]);
		$this->models->sureFriends($check);
		$this->success();
	}
	//拒绝添加好友
	public function refuseAction()
	{
		$check = $this->fill([
				['add_id', 0, 'int'],
			]);
		$this->models->refuseFriends($check);
		$this->success();
	}

	public function deleteAction()
	{
		$check = $this->fill([
				['friends_id', 0, 'int'],
			]);
		$this->models->deleteFriends($check);
		$this->success();
	}
}
?>