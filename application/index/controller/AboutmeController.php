<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;
use app\index\model\Learn;


class AboutmeController extends Controller
{
    protected function _initialize(){

        $this->date = Db::table("think_config")->field("name,title")->select();

    }

    public function index()
    {
        $view = new View();
        
        $list = Db::table("think_posts")->field("post_content")->where("pid = '12'")->find();
        $view->assign("list",$list);
        $view->assign('date',$this->date);
    	return $view->fetch();
    }

}
