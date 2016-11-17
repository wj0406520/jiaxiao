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

	//首页推荐服务
	public function serverAction()
	{
		$a=$this->models->server();

		$this->success($a);

	}
	//首页推荐商品
	public function shopAction()
	{

		$a=$this->models->shop();

		$this->success($a);

	}

	// 发送验证码
	public function sendAction()
	{
        $check=$this->validate(array(
              'phone'=>array('phone','phone'),
            ));

		$a=$this->models->sendmsg($check);

		if($a){
			$this->success();
		}else{
			$this->errorMsg($this->models->error);
		}
	}

	// 全局搜索
	public function searchAction()
	{

	// 瀚客资讯、瀚客活动、瀚客公益、投融资、服务、商品
		$check=$this->fill(array(
				array('search','','string'),
				array('page',1,'int'),
				array('pagesize',6,'int'),
			));

		$a=$this->models->search($check);

		$this->success($a);

	}

	public function textAction()
	{

		// $a=core\Error::diyError();
		// $str='';
		// foreach ($a as $key => $value) {
		// 	$str.='|'.$value[0].'|'.$value[1].'|'."\r\n";
		// }
		// echo $str;
		// exit;
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