<?php
namespace app\admin\controller;
use app\admin\model\Administrator;
use app\admin\model\Posts;
use app\admin\model\Config;
use app\admin\controller\AdminAuth;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;
class ConfigureController extends AdminAuth
{
    //模块基本信息
    private $data = array(
        'module_name' => '网站配置',
        'module_url'  => '/admin/Configure/',
        'module_slug' => 'configure',
        'upload_path' => UPLOAD_PATH,
        'upload_url'  => '/public/uploads/',
        'ckeditor'    => array(
            'id'     => 'ckeditor_post_content',
            //Optionnal values
            'config' => array(
                'width'  => "100%", //Setting a custom width
                'height' => '400px',
                // 默认调用 Standard Package，以下代码为调用自定义工具栏，这些基础的主要用于前台用户富文本设置
                // 'toolbar'   =>  array(  //Setting a custom toolbar
                //     array('Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates'),
                //     array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
                //     array('Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat'),
                //     array('Styles','Format','Font','FontSize'),
                //     array('TextColor','BGColor')
                // )
            )
        ),
    );
    /**
     * [index 获取配置数据列表]
     * @return [type] [description]
     */
    public function index()
    {
        $list =  Config::paginate(10);
                        

        $this->assign('data',$this->data);
        $this->assign('list',$list);
        return view();
    }

    public function create()
    {
        $this->data['edit_fields'] = array(
            'name'     => array('type' => 'text', 'label' => '标题'),
            'title'   => array('type' => 'textarea', 'label' => '内容'),
            
        );
        $this->assign('data',$this->data);
        return view();
    }

    public function add()
    {
        $Config = new Config;
        $data = input('post.');

        $rule = [
            'name|标题' => 'require',
            'title|内容' => 'require',
        ];
        // 数据验证
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(!$result){
            return  $validate->getError();
        }
        $data['add_time'] = time();

        if ($id = $Config->validate(true)->insertGetId($data)) {
            return $this->success('添加成功',$this->data['module_url'].$id);
        } else {
            return $this->error($posts->getError());
        }
    }
    public function read($id='')
    {
        $item = Config::get($id);

        $this->data['edit_fields'] = array(
            'name'     => array('type' => 'text', 'label' => '标题'),
            'title'   => array('type' => 'textarea', 'label' => '内容'),
            
        );
        $this->assign('data',$this->data);
        $this->assign('item',$item);
        return view();
    }

    public function delete($id)
    {
        $Config = new Config;
        $data['id'] = $id;
        if ($Config->where("id = '$id'")->delete()) {
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }
        return $data;
    }

    public function update($id)
    {
        $data = input('post.');
        $data['id'] = $id;
        if($data['id']){
            $rule = [
                'name|标题' => 'require',
                'title|内容' => 'require',
            ];
            // 数据验证
            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                return  $validate->getError();
            }
            $data['add_time'] = time();
            if ($id = Config::where("id = ".$data['id'])->update($data)) {
                return $this->success('修改成功','index');
            } else {
                return $this->error($user->getError());
            }
        } else {
            $this->error("错误异常",'index');
        }
    }

    //清空缓存
    public function cache()
    {
        header("Content-type: text/html; charset=utf-8");
        //清文件缓存
        $dirs = array(dirname(dirname(dirname(dirname(__FILE__)))).'/runtime'."/");
        @mkdir(dirname(dirname(dirname(dirname(__FILE__)))).'/runtime'."/",0777,true);
        //清理缓存
        foreach($dirs as $value) {
            rmdirr($value);
        }
        $infos =  '<div ><h1 style=" margin-top: 25%;margin-left: 35%;">系统缓存清除成功！</h1></div>';  
        $this->assign('infos',$infos);
        $this->assign('data',$this->data);
        return view();
    }

    //查看日志
    public function journal()
    {
        $this->data['edit_fields'] = array(
            'name'     => array('type' => 'text', 'label' => '标题'),
            'title'   => array('type' => 'textarea', 'label' => '内容'),
            
        );
        $list = Db::table("think_journal")->order('add_time')->paginate(10);
        $this->assign('list',$list);
        $this->assign('data',$this->data);
        return view();
    }

    //指定IP登录
    public function linkip()
    {
        $list = Db::table("think_linkip")->order('add_time')->paginate(10);
        $page = $list->render();
        $this->assign('page',$page);
        $this->assign('list',$list);
        $this->assign('data',$this->data);
        return view();
    }

    public function createip()
    {
        $this->data['edit_fields'] = array(
            'ip'      => array('type' => 'text', 'label' => 'IP'),
            'title'   => array('type' => 'textarea', 'label' => '备注'),
        );
       
        $this->assign('data',$this->data);
        return view();
    }

    public function addip()
    {
        $linkip = Db::table("think_linkip");
        $data = input('post.');

        $rule = [
            'ip|iP' => 'require|ip',
        ];
        // 数据验证
        $validate = new Validate($rule);
        $result   = $validate->check($data);
        if(!$result){
            return  $validate->getError();
        }
        $data['add_time'] = time();
        if ($linkip->insert($data)) {
            return $this->success('添加成功',"linkip");
        } else {
            return $this->error($posts->getError());
        }
    }

    public function readip($id='')
    {
        $item = Db::table("think_linkip")->where("id = '$id'")->find();

        $this->data['edit_fields'] = array(
            'ip'     => array('type' => 'text', 'label' => 'IP'),
            'title'   => array('type' => 'textarea', 'label' => '备注'),
        );
        $this->assign('data',$this->data);
        $this->assign('item',$item);
        return view();
    }

    public function updateip($id)
    {
        $data = input('post.');
        $data['id'] = $id;
        if($data['id']){
            $rule = [
                'ip|iP' => 'require|ip',
            ];
            // 数据验证
            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                return  $validate->getError();
            }
            $data['add_time'] = time();
            if (Db::table("think_linkip")->where("id = ".$data['id'])->update($data)) {
                return $this->success('修改成功','linkip');
            } else {
                return $this->error($user->getError());
            }
        } else {
            $this->error("错误异常",'linkip');
        }
    }

    public function deleteip($id)
    {
        $linkip = Db::table("think_linkip");
        $data['id'] = $id;
        if ($linkip->where("id = '$id'")->delete()) {
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }
        return $data;
    }
}