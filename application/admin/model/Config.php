<?php
namespace app\admin\model;

use think\Model;

class Config extends Model
{

    // 设置完整的数据表（包含前缀）
    protected $table = 'think_config';

    // 关闭自动写入时间戳
    //protected $autoWriteTimestamp = false;

    //默认时间格式
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $type       = [
        // 设置时间戳类型（整型）
        'add_time'        => 'timestamp',
    ];

    //自动完成
    protected $insert = [
    	'add_time',
    ];

    protected $update = ['add_time'];



}

