<?php
namespace app\index\controller;
use app\index\controller\IndexAuth;
use think\Controller;
use think\Db;
use think\View;
use app\index\model\Learn;


class BrokenController extends Controller
{
    protected function _initialize(){

        $this->date = Db::table("think_config")->field("name,title")->select();

    }

    public function index()
    {
        $view = new View();
        $list = Learn::field("feature_image,post_excerpt,create_time")->where("pid = '14'")->order('create_time')->paginate(10);

        $view->assign('list',$list);
        $view->assign('date',$this->date);
    	return $view->fetch();
    }

}
