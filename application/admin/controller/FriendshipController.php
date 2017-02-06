<?php
namespace app\admin\controller;
use app\admin\model\Administrator;
use app\admin\model\Posts;
use app\admin\model\Friendship;
use app\admin\controller\AdminAuth;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;
class FriendshipController extends AdminAuth
{
	//模块基本信息
	private $data = array(
		'module_name' => '友情链接',
		'module_url'  => '/admin/Friendship/',
		'module_slug' => 'friendship',
		'upload_path' => UPLOAD_PATH,
		'upload_url'  => '/public/uploads/',
        'ckeditor'    => array(
            'id'     => 'ckeditor_post_content',
            //Optionnal values
            'config' => array(
                'width'  => "100%", //Setting a custom width
                'height' => '400px',
            )
        ),
	);


    /**
     * [index 获取友情链接数据列表]
     * @return [type] [description]
     */
    public function index()
    {
        $list = Friendship::paginate(10);
        $this->assign('list',$list);
        $this->assign('data',$this->data);
        return $this->fetch();
    }

    public function create()
    {
        $this->data['edit_fields'] = array(
            'name'     => array('type' => 'text', 'label' => '标题'),
            'link'     => array('type' => 'text', 'label' => '网址'),
            
        );
        $this->assign('data',$this->data);
        return view();
    }

    public function add()
    {
        $Config = new Friendship;
        $data = input('post.');

        $rule = [
            'name|标题' => 'require',
            'link|网址' => 'require|url',
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
        $item = Friendship::get($id);

        $this->data['edit_fields'] = array(
            'name'     => array('type' => 'text', 'label' => '标题'),
            'link'     => array('type' => 'text', 'label' => '网址'),
            
        );
        $this->assign('data',$this->data);
        $this->assign('item',$item);
        return view();
    }

    public function update($id)
    {
        $data = input('post.');
        $data['id'] = $id;
        if($data['id']){
            $rule = [
                'name|标题' => 'require',
                'link|网址' => 'require|url',
            ];
            // 数据验证
            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                return  $validate->getError();
            }
            $data['add_time'] = time();
            if ($id = Friendship::where("id = ".$data['id'])->update($data)) {
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
        $Config = new Friendship;
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
}