<?php

namespace admin\controls;

use core;

defined('ACC')||exit('ACC Denied');


class all extends core\Controls{


    public function before()
    {

    	if($this->check==1 && !isset($_SESSION['user_id']) && strpos($this->controlsname,'login')===false){
			$this->redirect('/login/');
    	}
    }
}
?>