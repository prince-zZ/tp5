<?php
namespace app\index\model;

use think\Model;

class Learn extends Model
{

    // 设置完整的数据表（包含前缀）
    protected $table = 'think_posts';


    //默认时间格式
    protected $dateFormat = 'Y-m-d';

    protected $type       = [
        // 设置时间戳类型（整型）
        'create_time'     => 'timestamp',
        'update_time'     => 'timestamp',
    ];

    //自动完成
    protected $insert = [
        'create_time',
        'update_time',
    ];

    protected $update = ['update_time'];


}