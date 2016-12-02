<?php

/**
 * 分组控制器
 */
namespace api\controls;

use core;

defined('ACC')||exit('ACC Denied');


class group extends all
{


	//分组列表
	public function indexAction()
	{

		$a = $this->models->getList();

		$this->success($a);

	}
	// 新增分组
	public function addAction()
	{
		$post = $this->validate([
			'name' => ['groupName', 'length', '1,20'],
		]);
		$this->models->addGroup($post);

		$this->success();
	}
	// 删除分组
	public function deleteAction()
	{
		$check = $this->fill([
				['group_id', 0, 'int'],
			]);

		$this->models->deleteGroup($check);

		$this->success();
	}

	// 修改分组
	public function createAction()
	{
		$check = $this->fill([
				['group_id', 0, 'int'],
			]);
		$post = $this->validate([
			'name' => ['groupName', 'length', '1,20'],
		]);
		$check = array_merge($check, $post);

		$this->models->createGroup($check);

		$this->success();
	}
	// 分组用户
	public function listAction()
	{
		$a=$this->models->listGroup();
		$this->success($a);
	}
}
?>