<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
     // 全局变量规则定义
    '__pattern__'         => [
        'name'  => '\w+',
        'id'    => '\d+',
        'year'  => '\d{4}',
        'month' => '\d{2}',
    ],
    // 路由规则定义
    //登录
    'admin/login/'                               => 'admin/index/login',
    'admin/login_action/'                        => 'admin/index/login_action',
    'admin/lost_password/'                       => 'admin/index/lost_password',
    'admin/logout/'                              => 'admin/index/logout',

    //管理员管理
    'admin/administrator/:id'                    => 'admin/administrator/read',
    'admin/administrator/update/:id'             => 'admin/administrator/update',
    'admin/administrator/delete/:id'             => 'admin/administrator/delete',
    'admin/administrator/delete_image/:id'       => 'admin/administrator/delete_image',
    'admin/administrator/update_expire_time/:id' => 'admin/administrator/update_expire_time',

    //分类管理
    'admin/classification/read/:id'              => 'admin/classification/read',
    'admin/classification/delete/:id'            => 'admin/classification/delete',
    
    //文章管理
    'admin/posts/:id'                            => 'admin/posts/read',
    'admin/posts/update/:id'                     => 'admin/posts/update',
    'admin/posts/delete/:id'                     => 'admin/posts/delete',
    'admin/posts/delete_image/:id'               => 'admin/posts/delete_image',

    //RBAC管理
    'admin/Rbac/:id'                             => 'admin/Rbac/read',
    'admin/Rbac/update/:id'                      => 'admin/Rbac/update',
    'admin/Rbac/delete/:id'                      => 'admin/Rbac/delete',
    'admin/Rbac/rbacedit/:id'                    => 'admin/Rbac/rbacedit',
    'admin/Rbac/delete_image/:id'                => 'admin/Rbac/delete_image',
    'admin/Rbac/createedit/:id'                  => 'admin/Rbac/createedit',
    'admin/Rbac/del/:id'                         => 'admin/Rbac/del',

    //网站配置
    'admin/configure/:id'                        => 'admin/configure/read',
    'admin/configure/delete/:id'                 => 'admin/configure/delete',
    'admin/configure/update/:id'                 => 'admin/configure/update',
    'admin/configure/readip/:id'                 => 'admin/configure/readip',
    'admin/configure/updateip/:id'               => 'admin/configure/updateip',
    'admin/configure/deleteip/:id'               => 'admin/configure/deleteip',

    //友情連接
    'admin/friendship/:id'                       => 'admin/friendship/read',
    'admin/friendship/delete/:id'                => 'admin/friendship/delete',
    'admin/friendship/update/:id'                => 'admin/friendship/update',


    //首页
    'index/index/details/:id'                    => 'index/index/details',
    'index/index/'                               => 'index/index/',
    //学无止境
    'learn/index/'                               => 'learn/index/',
    //关于我
    'aboutme/index/'                             => 'aboutme/index/',
    //慢生活
    'life/index'                                 => 'life/index/',

    //碎言碎语
    'broken/index'                               => 'broken/index/',

];
