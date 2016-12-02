<?php

namespace admin\controls;

use core;

defined('ACC')||exit('ACC Denied');


class psw extends all{

	public $table='admin';

	public function indexAction(){
		
		$this->display('admin');

		exit;

	}



	public function postAction(){

		if(IS_POST){

			$arr=$this->checkSearch(array('old'=>'','new'=>'','repeat'=>''),1);
			// header('location:/index');
			if($arr['new']!=$arr['repeat']){
      			message('确认密码错误');
			}

			if(strlen($arr['old'])<6){
      			message('密码少于6位');
			}

		    $old=md5($_POST['old']);

		    $user=$this->models->table($this->table)->fetchSql(0)->find($_SESSION['user_id']);
		    
		    
		    if($user['password']!=$old){
		       message('旧密码错误');
		    }

		    $new = md5($_POST['new']);
		    // echo $new;
		    // exit;
		    $ss=$this->models->save(array('password'=>$new),$_SESSION['user_id']);
		   
			message('密码修改成功');
	
		   
		}
		// exit;
		$this->redirect('/admin');

	}

	//退出
	public function topAction(){
		session_destroy();
		$this->redirect('/index');
		exit;
	}


}
?>