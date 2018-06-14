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

/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/
use think\route;

//Route::rule('show','index/index/show'); //此时只能访问localhost/thinkphp/public/show ,如还访问之前的localhost/thinkphp/public/index/index/show会报错


//Route::rule('show/:id','index/index/show');//url不输入id会报错//localhost/thinkphp/public/show/5 前端控制器中的方法如下

/*    public function show(){
        echo input('id');

    }*/


//Route::rule('show/[:id]','index/index/show');//url不输入id也不会报错


//Route::rule('show/[:id]/[:name]','index/index/show');
//Route::rule('show/[:id]/[:name]/[:sex]','index/index/show');
//Route::rule('[:id]/[:name]/[:sex]','index/index/show');
//Route::rule(':id/:name/:sex','index/index/show');//


//Route::rule('show$','index/index/show');//$表示以show结尾，访问时url后面只能到show，再写其它报错
//Route::rule('show/[:id]$','index/index/show');//$表示以show的id为结尾（因为有[]，此时id可写可不写），再多写也会报错


//Route::rule('show11/[:id]$','index/index/show','get');
//Route::rule('show/[:id]$','index/index/show','post');


//Route::get('show','index/index/show');
//Route::post('show','index/index/show');//此时在form表单提交时action的链接可以是完整的http://www.tp.com/show或者只写show


//Route::rule('show/[:id]','index/index/show','post|get');
//上面几种是get请求和post请求的几种写法，get可以单独写，如果是post请求必须也得带上get




//*******批量注册路由,以下两种写法都可以
/*Route ::rule([
	'user'=>'index/index/show',
	'index'=>'index/index/index',
	'demo'=>'index/index/user'
	]);

return ([
	'user'=>'index/index/show',
	'index'=>'index/index/index',
	'demo'=>'index/index/user'
	]);*/




//view的用法   
//return view('index/index');//view里面的index下的index的页面
//return view('demo/index');//view里面的demo下的index页面


//Route::get('demo','index/index/demo');
