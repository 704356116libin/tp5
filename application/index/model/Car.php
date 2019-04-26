<?php
/**
 * Created by PhpStorm.
 * User: bin
 * Date: 2019/4/26
 * Time: 20:02
 */

namespace app\index\model;


use think\Model;

class Car extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'cars';

    // 设置当前模型的数据库连接
    protected $connection = 'db_config';

    // 模型初始化
    protected static function init()
    {
        //TODO:初始化内容
    }
}