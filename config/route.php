<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '__alias__' =>  [
//        'fuck'  =>  'index/Fuck',
//    ],
Route::group('my', function () {
    Route::get(':id', 'my/demo');
});
Route::group('index', function () {
    Route::get('/demmo/:id', 'demo/demo',[],['id'=>'\d+']);
    Route::get('/demo2', 'demo/demo2');
});
//    '[fuck]'     => [
//        '[:id]'   => ['index/demo/demo', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/demo', ['method' => 'post']],
//    ],

Route::get('tp/:name', function ($name) {
    return 'tp,' . $name;
});
//];
