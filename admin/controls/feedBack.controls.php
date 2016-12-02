<?php

namespace admin\controls;

use core;

defined('ACC')||exit('ACC Denied');


class feedBack extends all{


	public $table='feed_back';
	public function indexAction(){
		// $this->display("index",array('type'=>diyType('jxtype')));
		// exit;
		
		//实例化翻页类
		$p=new \tool\PageTool();

		//查询条件 翻页
		$array=array('page'=>1,'pagesize'=>10,'type'=>0);
		$array=$this->checkSearch($array,1);
		
		//返回总数
		$infoa=$this->models->infoall($array,1);
		if ($infoa) {
		//翻页类返回值
		$pageT=$p->pageShow($infoa,$array['page'],$array['pagesize']);
		// echo $pageT;
		
		$info=$this->models->infoall($array);
		
		
		}else{
			$info='';
			$pageT="";
		}
		//查询数据
		$this->display('feedBack_list',array(
				'array'=>$array,
				'info'=>$info,
				'type'=>diyType('jxtype'),
				'page'=>$pageT
		));
		

	}

	//详情
	public function infoAction(){
		$arr=array($id=array('id','','int'));
		$arr=$this->fill($arr);
		
		if($arr['id']===""){
			message('帖子id非法');
		}
		$info=$this->models->feedBackinfo($arr);

		

		$this->display('feedBack_info',array(
									'info'=>$info,
									'type'=>diyType('jxtype')
			));
	}


}
?>