<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;
use app\index\model\Learn;



class LifeController extends Controller
{
    protected function _initialize(){

        $this->date = Db::table("think_config")->field("name,title")->select();

    }

    public function index()
    {
        $view = new View();
        $list = Learn::alias('a')->field("a.id,a.post_title,a.post_excerpt,a.feature_image,a.create_time,b.name,c.nickname")->join("think_classification b","a.pid = b.id")->join("think_administrator c","a.post_author = c.id")->where("a.pid = '2'")->limit(10)->order("a.create_time")->paginate(8);
        /*最新文章*/
        $info = Learn::alias('a')->field("id,post_title")->where("a.pid = '2'")->limit(8)->order('create_time')->select();
        /*点击排行*/
        $in = Learn::alias('a')->field("id,post_title")->where("a.pid = '2'")->limit(8)->order('comment_count')->select();
        /*栏目导航*/
        $column = Db::table("think_classification")->field("id,name")->where("pid = '6'")->select();

        $view->assign('column',$column);
        $view->assign('in',$in);
        $view->assign('info',$info);
        $view->assign('list',$list);

        $view->assign('date',$this->date);
    	return $view->fetch();
    }

}
