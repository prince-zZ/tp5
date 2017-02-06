<?php
namespace app\admin\controller;
use app\admin\model\Administrator;
use app\admin\model\Posts;
use app\admin\controller\AdminAuth;
use think\Validate;
use think\Image;
use think\Request;
class MemberController extends AdminAuth
{
    //模块基本信息
    private $data = array(
        'module_name' => '会员',
        'module_url'  => '/admin/Member/',
        'module_slug' => 'Member',
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
        /*
        *   关联查询admin nickname
        *   Model 中设置了 getPostAuthorAttr 属性读取器，所以不需要用关联查询，
        *   或者可以取消属性读取器，用关联查询，但是由于没有设置属性读取器，
        *   在 create/read 页面,select/checkbox/radio字段默认值判断时不对，需要单独设置默认值
        */
        // $list =  Posts::view('posts','*')
        //                 ->view('administrator',['nickname'],'posts.post_author=administrator.id') //这里本人对关联查询写法不熟，手册中关联查询部分没有完整实例，试了几种方法（join(),model定义关联），最后用view写
        //                 ->where('posts.status','>=','0')
        //                 ->order('posts.create_time', 'DESC')
        //                 ->paginate();

        //直接查询,注：getPostAuthorAttr 中已经得到了 post_author 名称
        $request = request();
        $param = $request->param();

        $map['status'] = ['>=','0'];

        if(!empty($param)){
            $this->data['search'] = $param;
            if(isset($param['title'])){
                $map['post_title'] = ['like','%'.$param['title'].'%'];
            }

            if(isset($param['start_time']) || isset($param['end_time'])){
                if(isset($param['start_time']) && isset($param['end_time'])){
                    $map['create_time'] = ['between time',[$param['start_time'],$param['end_time']]];
                }

                if(isset($param['start_time']) && !$param['end_time']){
                    $map['create_time'] = ['>= time',$param['start_time']];
                }
                if(isset($param['end_time']) && !$param['start_time']){
                    $map['create_time'] = ['<= time',$param['end_time']];
                }
            }
        }


        $list =  Posts::where($map)
                        ->order('create_time', 'DESC')
                        ->paginate();

        $this->assign('data',$this->data);
        $this->assign('list',$list);
        return $this->fetch();
    }

}