<?php

namespace app\index\controller;

use app\index\model\User;
use think\Config;
use think\Controller;
use think\Db;
use think\View;

class Demo extends Controller
{
    protected $beforeActionList = [
        'first',
        'second' => ['except' => 'demo'],
        'three' => ['only' => 'demo,demo2'],
    ];

    protected function first()
    {
        echo 'first<br/>';
    }

    protected function second()
    {
        echo 'second<br/>';
    }

    protected function three()
    {
        echo 'three<br/>';
    }

    public function _initialize()
    {
        echo 'init<br/>';
    }

    public function demo($id)
    {

        // 或者使用助手函数完成相同的功能
        // download是系统封装的一个助手函数
//        return download('favicon.ico', 'd.ico');


        return redirect('https://www.dulifei.com')->params(['name'=>'thinkphp']);

        $data = 'Hello,ThinkPHP!';
        return response($data);

        dump(Db::connect(Config::load('database')['database']));
        return $this->request->param('name');
        $this->redirect('demo/demo2', ['cate_id' => 2]);
//        $this->success('新增成功', 'demo/demo2');
//        $this->error('新增失败');
//        $view = new View();
//        return $view->fetch('index');
        return '<h1>6666啊 ThinkPHP' . $id . '</h1>';
    }

    public function demo2($cate_id)
    {
        return '<h1>7777啊Demo.php ThinkPHP</h1>' . $cate_id;
    }

    /**
     * 数据库测试
     */
    public function db($id)
    {
        echo '模型查询数据库';
        dump(User::all()[0]->toArray());

        //查询
        $data = Db::table('users')->where('id', '>', $id)->select();
        $data = Db::table('users')->where('id', '>', $id)->value('name');
        $data = Db::table('users')->where('id', '>', $id)->column('name');

        //插入
//        $data = ['name' => 'foo', 'kk' => 'hjghjh'];
//        Db::name('users')->strict(false)->insert($data);
//        dump($data);

        // 根据主键删除
//        Db::table('think_user')->delete(1);
//        Db::table('think_user')->delete([1, 2, 3]);

        // 条件删除
//        Db::table('think_user')->where('id', 1)->delete();
//        Db::table('think_user')->where('id', '<', 10)->delete();

        // exp后边的不会当成字符串
        $data=Db::name('users')->where('id','exp',' IN (1,3) ')->select();
        dump($data);

        //数据绑定
        $data=Db::table('users')
            ->whereRaw("id=:id and name=:name", ['id' => [1, \PDO::PARAM_INT] , 'name' => '1111'])
            ->select();
        dump($data);
        //多表联合查询
        $data=Db::field('u.name,c.*')
            ->table('users u,user_card c')
            ->limit(10)->select();
        dump($data);

        //分页查询
        echo '分页查询';
        $data=Db::table('users')->limit(1,2)->select();
        dump($data);

//        $data=Db::table('users')
//                  ->field('id,name')
//                  ->order('id','desc')
//                  ->select();
//        dump($data);

       $data= Db::field('name')
            ->table('users')
            ->union(function ($query) {
                $query->field('name')->table('users');
            })
            ->union(function ($query) {
                $query->field('name')->table('users');
            })
            ->select();
        dump($data);
        dump(Db::table('users')->count('id'));

        //生成原声sql
        dump(Db::table('users')
                ->where('id','>',0)
                ->fetchSql()
                ->select()
        );

        //原声查询
        dump(Db::query("select id from users where id>1"));

        //查询获取
        echo '查询获取';
//        dump(Db::name('users')->withAttr('name', function($value, $data) {
//            return strtolower($value);
//        })->select());
    }

    /**
     * 模型数据库测试
     */
    public function model_db(){
        //分页查询
        echo '分页查询';
        $data=User::limit(1,2)->select();
        dump($data);
        $user = new User;
//        $user->save([
//            'name'  =>  'thinkphp',
//        ]);
        // 过滤post数组中的非数据表字段数据
        $user->allowField(true)->save([
            'a'=>123123,
            'name'=>'又一个',
        ]);
        echo '新建一个User';

    }
}
