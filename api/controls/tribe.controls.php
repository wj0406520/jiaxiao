<?php

namespace api\controls;

use core;

defined('ACC')||exit('ACC Denied');


class tribe extends all
{


	// 部落编号
	public function indexAction()
	{
		$a = $this->models->number();
		$this->success($a);
	}

	// 新增部落
	public function addAction()
	{

		$post = $this->validate([
				'name' => ['tribeName','length','2,10'],
				'number' => ['paramMiss','require'],
				'im' => ['paramMiss','require'],
				'face' => ['paramMiss','require'],
			]);

		$this->models->addTribe($post);
		$this->success();
	}

	// 部落列表
	public function listAction()
	{
		$arr=$this->checkArrayId($_POST['im']);
		if(!$arr){
			$this->errorMsg('paramError');
		}
		$re=$this->models->tribeList($_POST['im']);
		$this->success($re);
	}

	//删除部落
	public function deleteAction()
	{

		$check = $this->fill([
				['tribe_id', 0, 'int'],
			]);

		$this->models->deleteTribe($check);
		$this->success();
	}
}
?>