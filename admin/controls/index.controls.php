<?php

namespace admin\controls;

use core;

defined('ACC')||exit('ACC Denied');


class index extends all{



	public function indexAction(){

		

		$this->display();
		exit;

		$this->models();

		$this->models->index();

        // echo get_class($this);
        $class_methods = get_class_methods('index\models\index');
        // print_r($class_methods);
        // print_r(get_extension_funcs("mysqli"));
		$o=new core\Opera();

		// ;
		// $arr=array(
			// 'cat_id'=>array('neq'=>2),
			// 'pid'=>array('gt'=>2)
			// );
		// $str='ss=0';
		// $o->table('st_cc')->field('cat_id,pid')->where($arr)->where($str)->order('cat_id desc,pid')->limit('10,25');
		// $o->table('st_cc')->field('cat_id,pid')->where($arr)->where($str)->order('cat_id desc,pid')->page('1,25')->group('cat_id')->having('sss')
		// ->join('st_ii','w')->joinField('a.id=b.id')->comment('aaaaa');

		// ;

		// $ff=$o->table('st_cc')->field('cat_id,pid')->where($arr)->order('cat_id desc,pid')->fetchSql(0)->limit(10)->select();

		// print_r($ff);
		// print_r($_GET);
		$o->autocommit();


		
		$arr=array(
				'user_id'=>45,
				'password'=>'password+1'
			);
		$aa=$o->table('st_use')->fetchSql(0)->save($arr);
		$a=$aa?1:0;
		$aa=$o->query('slect aaa');
		$a=$aa?1:0;

        if($a){
        	$o->commit();
        }else{
        	$o->rollback();
        }
		
	}
	public function admin(){
		$this->display();
		// echo 111;
	}

}
?>