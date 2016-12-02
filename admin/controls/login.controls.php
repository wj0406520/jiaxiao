<?php

namespace admin\controls;

use core;

defined('ACC')||exit('ACC Denied');


class login extends all{



	public function indexAction(){
		
		$this->display('login');

	}
	public function postAction(){
		$arr=array('username'=>'0','password'=>'0');
		$arr=$this->checkSearch($arr);
		
	    if(empty($arr)){
			message('请输入您登录的帐号和密码'); 
	    }

	   	$array['password'] = md5($arr['password']);
	   	$array['user_name']=$arr['username'];

	    $row = $this->models('users')->verify_login($array);

	    if($row){
	    	//更新登录时间与登录id
	    	$data['last_login']=TIME;
	    	$data['last_ip']=$_SERVER['REMOTE_ADDR'];
	    	$data['user_id']=$row['user_id'];
	    	$this->models('users')->update_fields($data);
	    	//保存session
	        $_SESSION['user_id'] = $row['user_id'];

			$this->redirect('/index');
	    }
	    else{
			message('您输入的帐号信息不正确');
	    }
	}


}
?>