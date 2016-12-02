<?php

namespace admin\controls;

use core;

defined('ACC')||exit('ACC Denied');


class message extends all{

	public $check=0;

	public function indexAction(){

		$this->msg = isset($_GET['msg']) ? trim($_GET['msg']) : '系统错误，原因未知';
		$this->link = !isset($_GET['link']) ? $_GET['link'] : 'javascript:history.back();';

		$this->display('message');

		exit;
	}



}
?>