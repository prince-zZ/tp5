<?php
namespace app\admin\controller;
use app\admin\model\Administrator;
use app\admin\model\Posts;
use app\admin\model\Rbac;
use app\admin\controller\AdminAuth;
use think\Validate;
use think\Image;
use think\Request;
use think\Db;
class RbacController extends AdminAuth
{
	//模块基本信息
    private $data = array(
        'module_name' => '权限管理',
        'name'        => '权限',
        'module_url'  => '/admin/Rbac/',
        'module_slug' => 'rbacController',
        'upload_path' => UPLOAD_PATH,
        'upload_url'  => '/public/uploads/',
    );
    /**
     *首页 
     */
    public function index()
    {
        $list = Rbac::paginate(10);

 
        $this->assign('list',$list);
    	$this->assign('data',$this->data);
		return $this->fetch();
	}

    /**
     *添加权限规则 
     */
	public function create()
	{
        if($_POST){
             $data = input('post.');
              $rule = [
                'name|管理组名称'   => 'require|min:2',
            ];
            // 数据验证
            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                return  $this->error($validate->getError());
            }
            $data['title'] = serialize($data['title']);
            $data['add_time'] = time();
            if (Db::table('think_rbac')->insert($data)) {
                return $this->success('添加成功',$this->data['module_url'].'index');
            } else {
                return $this->error($user->getError());
            }
        } else {
            $list = Db::table('think_rbac_name')->order('id')->select();
            $this->assign('list',$list);
    	    $this->assign('data',$this->data);
    		return $this->fetch();	
        }
	}

    public function createedit($id)
    {
        $id = intval($id);
        if($id){
            if($_POST){

                $data = input('post.');
                  $rule = [
                    'name|管理组名称'   => 'require|min:2',
                ];
                // 数据验证
                $validate = new Validate($rule);
                $result   = $validate->check($data);
                if(!$result){
                    return  $this->error($validate->getError());
                }
                $data['title'] = serialize($data['title']);
                $data['add_time'] = time();
                if (Db::table('think_rbac')->where("id = '$id'")->update($data)) {
                    return $this->success('修改成功',$this->data['module_url'].'index');
                } else {
                    return $this->error($user->getError());
                }
            } else {
                $info = Db::table('think_rbac')->where("`id` = '$id'")->find();
                $list = Db::table('think_rbac_name')->select();
                $info['title'] = unserialize($info['title']);
                foreach ($info['title'] as $k => $v) {
                    foreach ($list as $key => $value) {
                        if($v == $value['id']){
                            $list[$key]['checkeds'] = "checked";
                        }
                    }
                }
                foreach ($list as $k => $v) {
                    if(!isset($v['checkeds'])){
                        $list[$k]['checkeds'] = "";
                    }
                }
                
                $this->assign('list',$list);
                $this->assign('info',$info);
                $this->assign('data',$this->data);
                return $this->fetch();  
            }
        } else {
            $this->error("错误异常","index");
        }
    }

    /**
     * 查看权限  
     */
    public function rbac()
    {
        $list = Db::table('think_rbac_name')->paginate(10);
        $page = $list->render();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('data',$this->data);
        return $this->fetch();  
    }

    /**
     * 添加权限
     */
    public function rbacadd()
    {
        if($_POST){
            $data = input('post.');
            $rule = [
                'name|权限名称'   => 'require|min:2',
                'title|权限规则' => 'require|chsAlpha|min:2',
            ];
            // 数据验证
            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                return  $this->error($validate->getError());
            }
            if (Db::table('think_rbac_name')->insert($data)) {
                return $this->success('添加成功','rbac');
            } else {
                return $this->error("添加失败");
            }
        } else {
            $this->assign('data',$this->data);
            return $this->fetch();  
        }
    }

     /**
     * 修改权限
     */
    public function rbacedit($id)
    {
        if($id){
            $list = Db::table('think_rbac_name')->where("id = '$id'")->find();
            if($list){
                $data = input('post.');
                if($data){
                    $data = input('post.');
                    $rule = [
                        'name|权限名称'   => 'require|min:2',
                        'title|权限规则' => 'require|chsAlpha|min:2',
                    ];
                    // 数据验证
                    $validate = new Validate($rule);
                    $result   = $validate->check($data);
                    if(!$result){
                        return  $this->error($validate->getError());
                    }
                    $id = intval($data['id']);
                    if (Db::table('think_rbac_name')->where("id = '$id'")->update($data)) {
                        return $this->success('修改成功','rbac');
                    } else {
                        return $this->error("修改失败");
                    }
                } else {              
                    $this->assign('list',$list);
                    $this->assign('data',$this->data);
                    return $this->fetch(); 
                } 
            } else {
                $this->error("错误异常","rbac");
            }
        } else {
            $this->error("错误异常","rbac");
        }
    }

    /**
     * AJAX删除权限
     */
    public function delete($id)
    {
        $id = intval($id);
        if (Db::table('think_rbac_name')->where("id = '$id'")->delete()) {
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }
        return $data;
    }
    /**
     * AJAX删除权限规则
     */
    public function del($id)
    {
        $id = intval($id);
        if (Db::table('think_rbac')->where("id = '$id'")->delete()) {
            $data['error'] = 0;
            $data['msg'] = '删除成功';
        } else {
            $data['error'] = 1;
            $data['msg'] = '删除失败';
        }
        return $data;
    }
}
