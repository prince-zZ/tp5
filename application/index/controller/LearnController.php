<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;
use app\index\model\Learn;


class LearnController extends Controller
{
    protected function _initialize(){

        $this->date = Db::table("think_config")->field("name,title")->select();

    }

    public function index()
    {
        $view = new View();
        
        $list = Learn::alias('a')->field("a.id,a.post_title,a.post_excerpt,a.feature_image,a.create_time,b.name,c.nickname")->join("think_classification b","a.pid = b.id")->join("think_administrator c","a.post_author = c.id")->limit(10)->order("a.create_time")->paginate(8);
        /*最新文章*/
        $info = Learn::alias('a')->field("id,post_title")->limit(8)->order('create_time')->select();
        /*点击排行*/
        $in = Learn::alias('a')->field("id,post_title")->limit(8)->order('comment_count')->select();
        /*栏目导航*/
        $column = Db::table("think_classification")->field("id,name")->where("pid = '6'")->select();

        $view->assign('column',$column);
        $view->assign('in',$in);
        $view->assign('info',$info);
        $view->assign('list',$list);
        $view->assign('date',$this->date);
    	return $view->fetch();
    }

    //ajax获取文章
    public function ajax()
    {   
        $id = intval($_POST['id']);
        if($id){
            $list = Learn::alias('a')->field("a.id,a.post_title,a.post_excerpt,a.feature_image,a.create_time,b.name,c.nickname")->join("think_classification b","a.pid = b.id")->join("think_administrator c","a.post_author = c.id")->where("a.pid = '$id'")->limit(10)->order("a.create_time")->paginate(8);
            if($list){
                $column = Db::table("think_classification")->field("id,name")->where("id = '$id'")->find();
                $arr = "<div class='newblog left' id='bk'>";
                foreach ($list as $v) {

                      $arr .= "<h2>$v->post_title</h2>";
                      $arr .= "<p class='dateview'><span>发布时间：$v->create_time</span><span>作者：$v->nickname</span><span>分类：[<a href='/news/life/'>$v->name</a>]</span></p>";
                      $arr .= "<figure><img src='/uploads/$v->feature_image'></figure>";
                      $arr .= "<ul class='nlist'><p>$v->post_excerpt</p>";
                      $arr .= "<a title='/' href='/index/index/details/$v->id' target='_blank' class='readmore'>详细信息>></a></ul><div class='line'></div>";
                }
                $arr .= "<div class='blank'></div><div class='page'>".$list->render()."</div></div>";
                $data['error'] = 1;
                $data['msg'] = $arr;
                $data['n2'] = $column['name'];
            } else {
                $data['error'] = 0;
                $data['msg'] = "暂无信息";
            }
            return $data;
        } else {
            return fasle;
        }
    }

}
