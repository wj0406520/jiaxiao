<?php

namespace api\controls;

use core;

defined('ACC')||exit('ACC Denied');


class index extends all
{

	public $check=0;

	//程序运行了
	public function indexAction()
	{

		$this->success();

	}


	// 发送验证码
	public function sendAction()
	{
        $check = $this->validate([
              'phone' => ['phone', 'phone'],
            ]);

		$a = $this->models->sendmsg($check);

		$this->success();

	}


	public function textAction()
	{

		$a=core\Error::diyError();
		$str='';
		foreach ($a as $key => $value) {
			$str.='|'.$value[0].'|'.$value[1].'|'."\r\n";
		}
		echo $str;
		exit;
		$arr['action']=IS_POST;
		$arr['post']=$_POST;
		$arr['request']=$_REQUEST;
		$arr['cookie']=$_COOKIE;
		$arr['get']=$_GET;
		$arr['file']=$_FILES;
		echo json_encode($arr);
	}
}
?>