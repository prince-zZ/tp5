<?php
namespace app\index\controller;
use app\index\controller\IndexAuth;
use think\Controller;
use think\Db;
use think\View;
use app\index\model\Index;


class IndexController extends Controller
{
	protected function _initialize(){

		$this->date = Db::table("think_config")->field("name,title")->select();

	}

    public function index()
    {
    	$view = new View();
    	/*文章推薦*/
    	$list = Index::alias('a')->field("a.id,a.post_title,a.post_excerpt,a.feature_image,a.create_time,b.name,c.nickname")->join("think_classification b","a.pid = b.id")->join("think_administrator c","a.post_author = c.id")->where("a.type = '1'")->limit(10)->order("a.create_time")->select();
    	/*最新文章*/
    	$info = Index::field("id,post_title")->limit(8)->order('create_time')->select();
    	/*点击排行*/
    	$in = Index::field("id,post_title")->limit(8)->order('comment_count')->select();
    	/*友情链接*/
    	$link = Db::table("think_friendship")->field("name,link")->select();

    	$view->assign('link',$link);
    	$view->assign('in',$in);
    	$view->assign('info',$info);
    	$view->assign('list',$list);
		$view->assign('date',$this->date);
		return $view->fetch();
    }

    public function details($id = '')
    {
    	$id = intval($id);
    	$view = new View();
    	$list = Index::alias('a')->field("a.id,a.post_title,a.post_content,a.create_time,c.nickname,a.comment_count,a.pid,b.name,b.id as uis")->join("think_classification b","a.pid = b.id")->join("think_administrator c","a.post_author = c.id")->where("a.type = '1' and a.id = '$id'")->order("a.create_time")->find();
    	$ip = get_ip();
    	$in = Db::table('think_count')->where("pid = '$id' and ip = '$ip'")->find();

    	if($in){
    		if($in['add_time'] < time()){
    			$datas['comment_count'] = $list['comment_count'] + 1;
    			Index::where("id = '$id'")->update($datas);
		    	$data['add_time'] = strtotime("+ 1 day");
		    	Db::table('think_count')->where("pid = '$id' and ip = '$ip'")->update($data);
    		} 
    	} else {
    		$datas['comment_count'] = $list['comment_count'] + 1;
    		Index::where("id = '$id'")->update($datas);
	    	$data['pid'] = $id;
	    	$data['ip'] = $ip;
	    	$data['add_time'] = strtotime("+ 1 day");
	    	Db::table('think_count')->insert($data);
    	}
    	/*点击排行*/
    	$ins = Index::field("id,post_title")->limit(8)->order('comment_count')->select();
    	/*栏目最新*/
    	$newest = Index::field("id,post_title")->where("pid = ".$list['pid'])->limit(8)->order('comment_count')->select();

        $view->assign('newest',$newest);
    	$view->assign('in',$ins);
    	$view->assign('list',$list);
		$view->assign('date',$this->date);
    	return $view->fetch();
    }
}
