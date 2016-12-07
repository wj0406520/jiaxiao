<?php

namespace api\controls;

use core;

defined('ACC')||exit('ACC Denied');


class login extends all
{

	public $check=0;

	//登录接口
	public function postAction()
	{

		$post = $this->validate([
				'phone' => ['phone','phone'],
              	'password' => ['password','length','6,16'],
			]);

		$a = $this->models->checkPsw($post['phone'], $post['password']);

		if (!$a) {
			$this->errorMsg('login');
		}

		$token = $a['id'] . '|' . token();

		$this->models->create(['token' => $token, 'id' => $a['id']]);

		$arr['token'] = $token;
		$arr['type']=$a['type'];
		$arr['im']=$a['im'];

		$this->success($arr);

	}

	//注册接口
	public function registerAction()
	{

		$post = $this->validate([
				'phone' => ['phone', 'phone'],
				'name' => ['username', 'length', '2,6'],
				'type' => ['typeError', 'in', '1,2,3,4'],
              	'password' => ['password', 'length', '6,16'],
              	'code' => ['code', 'length', '6,6']
			]);


		$a = $this->models->checkUser($post['phone']);

		if ($a) {
			$this->errorMsg('havuse');
		}

		// $this->models('index')->checkphone($post['phone'],$post['code']);
        // $this->models();

		$array = [
			'phone' => $post['phone'],
			'name' => $post['name'],
			'type' => $post['type'],
			'password' => md5($post['password']),
			'create_time' => TIME
			];

		$a = $this->models->create($array);

		$a = $this->models->insertId();

		$im=$this->models('im')->registerIm(['id'=>$a,'nickname'=>$post['name']]);

		$this->models();

		$token = $a . '|' . token();

		$this->models->create(['token' => $token, 'id' => $a, 'im'=> $im]);

		$arr['token'] = $token;
		$arr['im'] = $im;
		$arr['type'] = $array['type'];

		$this->success($arr);
	}

	//忘记密码
	public function forgetAction()
	{

		$post = $this->validate([
				'phone' => ['phone','phone'],
              	'password' => ['password','length','6,16'],
              	'code' => ['code','length','6,6']
			]);

		$a = $this->models->checkUser($post['phone']);

		if (!$a) {
			$this->errorMsg('usermiss');
		}

        // $this->models('index')->checkphone($post['phone'],$post['code']);
        // $this->models();

		$this->models->create(['id' => $a, 'phone' => $post['phone'], 'password' => md5($post['password'])]);

		$this->success();
	}


	public function textAction()
	{
		$this->models->registerIm(['id'=>1,'nickname'=>'haha']);
	}
}
?>