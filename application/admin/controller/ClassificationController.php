<?php
namespace app\admin\controller;
// use app\admin\model\Administrator;
// use app\admin\model\Posts;
use app\admin\controller\AdminAuth;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;
class ClassificationController extends AdminAuth
{
    //模块基本信息
    private $data = array(
        'module_name' => '分类',
        'module_url'  => '/admin/Classification/',
        'module_slug' => 'classification',
        'upload_path' => UPLOAD_PATH,
        'upload_url'  => '/public/uploads/',
    );
    /**
     * [index 获取配置数据列表]
     * @return [type] [description]
     */
    public function index()
    {
        $list = Db::table('think_classification')->where('pid = 0')->select();
        for ($i=0; $i < count($list); $i++) { 
            $info = Db::table('think_classification')->where("pid = '{$list[$i]['id']}'")->select();
            for ($s=0; $s < count($info); $s++) { 
                $infsos = Db::table('think_classification')->where("pid = '{$info[$s]['id']}'")->select();
                $info[$s]['subordinatee'] = $infsos;
            }
            $list[$i]['subordinate'] = $info;
        }
        $this->assign('data',$this->data);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function create()
    {
        $list = Db::table('think_classification')->where('pid = 0')->select();
        for ($i=0; $i < count($list); $i++) { 
            $info = Db::table('think_classification')->where("pid = '{$list[$i]['id']}'")->select();
            for ($s=0; $s < count($info); $s++) { 
                $infsos = Db::table('think_classification')->where("pid = '{$info[$s]['id']}'")->select();
                $info[$s]['subordinatee'] = $infsos;
            }
            $list[$i]['subordinate'] = $info;
        }
        $this->assign('data',$this->data);
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * [add 添加数据]
     * @return [type] [description]
     */
    public function add()
    {
        $info = Db::table('think_classification');
      
        $data = input('post.');
        $rule = [
            //管理员登陆字段验证
            'name|分类名称'     => 'require|min:2',
            'markname|分类唯一标志' => 'require|alpha',
        ];

        // 数据验证
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(!$result){
            return  $validate->getError();
        }
        $data['addtime'] = time();
        if ($id = $info->insert($data)) {
            return $this->success('分类添加成功','index');
        } else {
            return $this->error($user->getError());
        }
    }

    public function read($id='')
    {
        $id = intval($id);
        if($id){
            $item = Db::table('think_classification')->where("id = '$id'")->find();
            $list = Db::table('think_classification')->where('pid = 0')->select();
            for ($i=0; $i < count($list); $i++) { 
                $info = Db::table('think_classification')->where("pid = '{$list[$i]['id']}'")->select();
                for ($s=0; $s < count($info); $s++) { 
                    $infsos = Db::table('think_classification')->where("pid = '{$info[$s]['id']}'")->select();
                    $info[$s]['subordinatee'] = $infsos;
                }
                $list[$i]['subordinate'] = $info;
            }

            $this->assign('list',$list);
            $this->assign('item',$item);
            $this->assign('data',$this->data);
            return $this->fetch();
        } else {
            $this->error("错误异常",'index');
        }
    }

    public function update()
    {
        $info = Db::table('think_classification');
      
        $data = input('post.');
        if($data['id']){
            $rule = [
                //管理员登陆字段验证
                'name|分类名称'     => 'require|min:2',
                'markname|分类唯一标志' => 'require|alpha',
            ];
            // 数据验证
            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                return  $validate->getError();
            }
            $data['addtime'] = time();
            if ($id = $info->where("id = ".$data['id'])->update($data)) {
                return $this->success('分类修改成功','index');
            } else {
                return $this->error($user->getError());
            }
        } else {
            $this->error("错误异常",'index');
        }
    }

    public function delete($id)
    {
        $id = intval($id);
        if($id){
            $item = Db::table('think_classification')->where("id = '$id'")->find();
            $item2 = Db::table('think_classification')->where("pid = ".$item['id'])->find();
            if($item2){
                 $data['error'] = 1;
                 $data['msg'] = '删除失败,有子分类';
            }else{
                $item3 = Db::table('think_posts')->field("feature_image")->where("pid = ".$item['id'])->select();
                if($item3){
                    foreach ($item3 as $k => $v) {
                       @unlink($this->data['upload_path'] .'/'.$v['feature_image']);
                    }
                }
                $item5 = Db::table('think_posts')->where("pid = ".$item['id'])->delete();
                $item4 = Db::table('think_classification')->where("id = '$id'")->delete();
                if($item4 && $item5){
                    $data['error'] = 0;
                    $data['msg'] = '删除成功'; 
                }
            }
            
        } else {
            $data['error'] = 1;
            $data['msg'] = '错误异常';
        }
        return $data;
    }

}