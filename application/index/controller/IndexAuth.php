<?php
namespace app\index\controller;
use think\Controller;
use think\Model;
use think\Db;

class IndexAuth extends Controller {

	protected function _initialize(){

		// $this->date = Db::table("think_config")->field("name,title")->select();
		// $this->class = Db::table("think_classification")->field("name")->where("pid = 0")->order("num desc")->select();
		// $this->assgin('class',$this->class);
	}
}