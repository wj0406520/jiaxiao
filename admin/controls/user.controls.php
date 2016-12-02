<?php

namespace admin\controls;

use core;

defined('ACC')||exit('ACC Denied');


class user extends all{



	public function indexAction(){
		//实例化翻页类
		$p=new \tool\PageTool();

		//查询条件
		$arr=array('name'=>'','phone'=>'','type'=>0);
		$arr=$this->checkSearch($arr,0);

		//翻页
		$array=array('page'=>1,'pagesize'=>10);
		$array=$this->checkSearch($array,1);
		$array=array_merge($array,$arr);
		//返回总数
		$infoa=$this->models->infoall($array,1);
		//翻页类返回值
		$pageT=$p->pageShow($infoa,$array['page'],$array['pagesize']);
		
		//查询数据
		$info=$this->models->infoall($array);
		if(!$infoa){$pageT="";}

		$this->display('user',array(
				'arr'=>$arr,
				'info'=>$info,
				'sex'=>diyType('sex'),
				'type'=>diyType('jxtype'),
				'sfrz'=>diyType('sfrz'),
				'page'=>$pageT
		));

	}


}
?>