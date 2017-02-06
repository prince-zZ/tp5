<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;

class SSSController extends Controller
{

    public function index()
    {
    	 // ini_set("innodb_log_buffer_size",'16MB');
    	 // ini_set("innodb_log_file_size",'128MB');
    	 // ini_set("innodb_autoextend_increment",'128MB');
  //   	$view = new View();
		// $view->name = 'thinkphp';
		// // echo '<pre>';
		// //查询
		// $list = Db::table('go_shoplist')->select();
		// echo '<pre>';
		// var_dump($list);
		// // 修改
		// // $data['post_title'] = 'sss';
		// // $info = Db::table('think_posts')->where('id = 1')->update($data);
		// // $data['post_author'] = 1;
		// // $data['post_content'] = '没有内容';
		// // $data['post_title'] = '没有内容';
		// // $data['post_excerpt'] = '没有内容';
		// // $data['status'] = 1;
		// // $data['comment_status'] = 'closed';
		// // $data['post_password'] = '';
		// // $data['comment_count'] = 0;
		// // $data['feature_image'] = '';
		// // $data['create_time'] = time();
		// // $data['update_time'] = time();
		// // //插入
		// // for ($i=0; $i < 1000; $i++) { 
		// // 	$info = Db::table('think_posts')->insert($data);
		// // }
		
		// //删除
		// // $info = Db::table('think_posts')->where('id = 2')->delete();
		// // var_dump($list);
		// // var_dump($info);
		// return $view->fetch();
        // $data['sid'] = '1';
        // $data['cateid'] = '1';
        // $data['brandid'] = 1;
        // $data['title'] = 'closed';
        // $data['title_style'] = '';
        // $data['title2'] = 0;
        // $data['keywords'] = '';
        // $data['money'] = 10.00;
        // $data['yunjiage'] = 1;
        // $data['zongrenshu'] =1;
        // $data['canyurenshu'] =1;
        // $data['shenyurenshu'] =1;
        // $data['def_renshu'] =1;
        // $data['qishu'] =10;
        // $data['maxqishu'] =10;
        // $data['thumb'] ='shopimg/20161119/19076042521720.png a:5:{i:0;s:35:"shopimg/20161119/37734485521728.png";i:1;s:35:"shopimg/20161119/17056826521729.png";i:2;s:35:"shopimg/20161119/24376504521729.png";i:3;s:35:"shopimg/20161119/42710871521729.png";i:4;s:35:"shopimg/20161119/73050480521730.png";}   <p>欢迎使用云购系统，请注意字符长度限制哦~!</p>';
        // $data['picarr'] ='a:5:{s:3:"uid";s:1:"5";s:8:"username";s:6:"微微";s:5:"email";s:0:"";s:6:"mobile";s:11:"17770889798";s:3:"img";s:16:"photo/member.jpg";}';
        // $data['content'] ='a:5:{s:3:"uid";s:1:"5";s:8:"username";s:6:"微微";s:5:"email";s:0:"";s:6:"mobile";s:11:"17770889798";s:3:"img";s:16:"photo/member.jpg";}';
        // $data['codes_table'] ='4';
        // $data['xsjx_time'] ='3';
        // $data['pos'] ='2';
        // $data['mianfei'] ='1';
        // $data['codes_table'] ='';
        // $data['renqi'] ='1';
        // $data['time'] =time();
        // $data['order'] =1;
      
        //插入
        //插入
        // $s = 0;
        // for ($i=0; $i < 100000; $i++) { 
        //     $info = Db::table('go_shoplist')->insert($data);
        //     // Db::table('go_shoplist')->getlastsql();
        //     echo $s++.date("Y-m-d H:i:s",time());
        //     echo '<hr>';
        // }

		// $data['title'] = '蒙牛 纯甄 常温酸牛奶 200gx12盒 礼盒装';
		// $info = Db::table('go_shoplist')->where("")->update($data);
    }
}
