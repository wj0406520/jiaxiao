<?php

/**
 * 帖子控制器
 */

namespace api\controls;

use core;

defined('ACC')||exit('ACC Denied');


class discuss extends all
{

	public $check=1;

	//程序运行了
	public function indexAction()
	{

		$this->success();

	}
	// 发帖
	public function postAction()
	{

		$check = $this->checkSearch([
				'title'=>'',
			]);

		$post = $this->validate([
			'content' => ['content', 'length', '1,5000'],
			'type' => ['typeError', 'in', '1,2,3,4']
		]);

		$check = array_merge($check, $post);

		$this->models->postInvita($check);

		$this->success();
	}
	// 回帖
	public function replyAction()
	{
		$check=$this->fill([
				['invita_id', 0, 'int'],
				['content', '', 'string'],
			]);

		$this->models->reply($check);

		$this->success();
	}
	// 点赞
	public function likeAction()
	{
		$check=$this->fill([
				['invita_id', 0, 'int'],
			]);

		$this->models->like($check);

		$this->success();
	}
	// 帖子列表
	public function listAction()
	{
		$check=$this->fill([
				['page', 1, 'int'],
				// ['pagesize', 6, 'int'],
			]);

		$post = $this->validate([
			'type' => ['typeError', 'in', '1,2,3,4'],
		]);

		$check['pagesize'] = 6;

		$check = array_merge($check, $post);

		$re = $this->models->getList($check);

		$this->success($re);
	}
	// 帖子详情
	public function infoAction()
	{
		$check=$this->fill([
				['invita_id', 0, 'int'],
				['page', 1, 'int'],
				['pagesize', 6, 'int'],
			]);

		$re = $this->models->info($check);

		$this->success($re);
	}
	// 帖子回复列表
	public function replyListAction()
	{
		$check=$this->fill([
				['page', 1, 'int'],
				['invita_id', 0, 'int'],
				// ['pagesize', 6, 'int'],
			]);

		$check['pagesize'] = 6;

		$re = $this->models->replyList($check);

		$this->success($re);
	}
}
?>