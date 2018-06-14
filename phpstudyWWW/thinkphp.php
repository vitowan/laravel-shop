<?php


localhost/thinkphp/public/index.php/index/index/index
//三个index分别表示：前台index目录；控制器名字（也是类名，因为类名跟控制器名要求必须一致）；控制器里面的方法



tp的开发模式：
0.开启调试模式：application下面的config.php中的'app_debug'=> true,
1.链接数据库：application里面的database.php进行配置




*********新建控制器（前台为例）
a.在控制器index\controller下新建User.php
b.控制器中写代码
namespace app\index\controller;//声明命名空间
//声明控制器
class User{
	//index方法
	public function index(){
		return '我是前台User控制器中的index方法';
	}
}
c.地址栏访问
index.php/Index/user/index

d.注意：
1.控制器文件名必须首字母大写

2.控制器中必须声明命名空间

3.控制器中类名必须和文件名一致




//************跨控制器调用3中方式
//例如前台index的controller里面调用后台User控制器
方法一：使用命名空间法
$model=new \app\admin\controller\User;//使用命名空间法
echo $model->index();//打印调用的admin的controller下面的index方法

方法二：使用use
或者在namespace下面写
use app\admin\controller\User;//如果是在当前的User类里面调用的，在new实例化的时候会冲突，可以变成use app\admin\controller\User as AdminUser
然后在下面的方法里调用如下
$model=new User;//跟上面对应$model=new AdminUser;
echo $model->index();

方法三：系统方法
$model=controller('admin\User');
echo $model->index();



//*********当前调用或者跨域调用，都可用此法
1.使用命名空间法
$model=new \app\admin\controller\Index;
echo $model->index();
2.使用use
use \app\admin\controller\Index as AdminIndex;//as后面是Index的别名，如果跟当前的类名冲突才使用，否者不需要
$model=new AdminIndex();
echo $model->index();


3.系统方法
//通常在thinkphp的helper.php里面
$model=controller('admin\Index');
echo $model->index();





*********调用当前控制器的方法
echo $this->test();
echo self::test();
echo Index::test();
echo action('test');//系统方法



*********调用前台User控制器中的index方法
//空间命名法
$model=new \app\index\controller\User;
echo $model->index();
//系统方法
echo action('User/index');



********调用后台模块下的Index控制器index方法
1.命名空间法
$model=new \app\admin\controller\Index;
echo $model->index();
2.系统方法
echo action('admin/Index/index');



**********总结：
//跨控制器调用
实例化当前模块的User控制器
controller('User');//实例化后再调用里面的方法
实例化后台模块的User控制器
controller('Admin/User');

//跨方法调用
实例化当前控制器的test方法
action('test');//实例化且直接调用了test方法
实例化当前模块User控制器test方法
action('User/test');
实例化Admin模块User控制器test方法
action('Admin/User/test');//外部调用时斜线反着写也可以









return View('index');//类似于display('index')

return View('show');//类似于display('show')












路由的作用
*简化URL地址，便于记忆
*有利于搜索引擎优化

前后台分离
1.在public下新建admin。
2.打开admin.php,复制index.php的文件到里面，加上下面定义常量
define('MIND_MODULE','admin');
在index.php里面也可以加上define('MIND_MODULE','index');,不加也可以






路由的三种模式：
1.普通模式(path_info形式)，一串斜线路径
2.混合模式（默认的），此时在config.php里面默认的如下    
// 是否开启路由
    'url_route_on'           => true,
    // 是否强制使用路由
    'url_route_must'         => false,
3.强制模式，都设置为true，在route.php里面写代码，如下
use think\route;//引用route类
Route::rule('show','index/index/show');用show换成index/index/show(入口文件已经隐藏的前提下，如果没隐藏，前面再加上index.php)，再打开连接时，直接输入public/show即可（之前是public/index/index/show）






//******** 关闭admin模块的路由,在admin入口文件admin.php里面加上如下代码，如果关闭index模块下的路由方法同理
\think\App::route(false);
// 执行应用
\think\App::run()->send();






设置路由传参
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


Route::get('show','index/index/show');
Route::post('show','index/index/show');//此时在form表单提交时action的链接可以是完整的http://www.tp.com/show或者只写show


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



//dump(url::build('index/index/demo'));生成.html后缀的url
//echo url('indexIndex/show');




////////////////////////////////////////////////////////////






数据库2种方式：sql语句形式，或者tp形式


查询语句
$query=Db::query('select * from `nav`');结果直接是数组，不用写mysqli_fetch_assoc，如果后面带where，结果是一个2位数组，$result[0]['title']才能获得值
//dump($query);
$this-assign('nav','query');
return view();

更改
Db::execute("update ...");

删除
Db::execute("delete...");

添加
Db::execute("insert...");//原生
Db::execute('insert into think_user (id, name) values (?, ?)',[8,'thinkphp']);
Db::execute('insert into think_user (id, name) values (:id, :name)',['id'=>8,'name'=>'thinkphp']);
insert 方法添加数据成功返回添加成功的条数，insert 正常情况返回 1//原生





方法二
**********添加
$a=Db::table('user')->insert(['username'=>$user,'password'=>$pass]);
//$a=Db::table('user')->insert($_POST);
if($a){
	$this->success('注册成功'，'index')
}else{
	$this->error('注册失败'，'index')
}
Db::execute('insert into think_user (id, name) values (?, ?)',[8,'thinkphp']);
Db::execute('insert into think_user (id, name) values (:id, :name)',['id'=>8,'name'=>'thinkphp']);
insert 方法添加数据成功返回添加成功的条数，insert 正常情况返回 1




***********查询
Db::table('nav')->select();
Db::table('nav')->where('id',2)->select();//返回的是二维数组
Db::table('think_user')->where('id',1)->find();//返回的是一维数组

Db::table('think_user')->where('id',1)->value('name');// 返回某个字段的值
Db::table('think_user')->where('status',1)->column('name');//返回列的值
// 指定索引
Db::table('think_user')->where('status',1)->column('name','id');
Db::table('think_user')->where('status',1)->column('id,name');

Db::table('表名')->where('name','Eric')->where('sex','woman')->select();
等价于：select  *   from  表名  where  name = ‘Eric’  and  sex = ’woman‘

Db::table('表名')->where('name','Eric')->whereOr('sex','woman')->select();
等价于：select  *   from  表名  where  name = ‘Eric’  or  sex = ’woman‘

Db::table('表名')->limit(2,3)->select();
	等价于：select  *   from  表名  limit  2,3

Db::table('表名')->field('name,age.sex')->select();
	等价于：select  name,age,sex  from  表名

Db::table('tab')->field('name,count(name)')->group('name')->select()
分组查询

Db::table('students')->field('students.name,score.html,score.css')->join('score','students.id=score.pid','right')->select();
多表查询






***********删除

Db::table('nav')->where('id',2)->delete();
// 根据主键删除
Db::table('think_user')->delete(1);
Db::table('think_user')->delete([1,2,3]);

// 条件删除    
Db::table('think_user')->where('id',1)->delete();
Db::table('think_user')->where('id','<',10)->delete();
delete 方法返回影响数据的条数，没有删除返回 0



*************更改
Db::table('think_user')->where('id', 1)->update(['name' => 'thinkphp']);
Db::table('think_user')->where('id',1)->setField('name', 'thinkphp');
update 方法返回影响数据的条数，没修改任何数据返回 0



事务机制
	自动控制事物
		在thinkPHP5中提供了一个函数，为系统自动控制事物  Db::transaction(function(){})  函数的参数是一个回调函数
		Db::transaction(function (){
            Db::table('user')->where('id','1')->delete();
            Db::table('user')->where('id','2')->deleasdte();
        });





跳转写路径的方法
<a href={:url('路径')}>
action={:url('Index/insert')}

//name值是assign过来的变量的值，values是变量循环遍历出来的值;{$valus.title} 写成{$valus['title']}也可以
{volist name='nav' id='values'}

{$values.title}
{$values.intro}
{$values.time}
{/volist}






、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、
	
	function direct(){
		$this->redirect('index/index/index');//重定向的，可以定向到当前模块中的controller类，也可转到其他的模块的controller类,因为继承controller类，只能跳转到controller里面
	}

	function tiao(){//此法经常用到数据库的增改删除的判断中
		//$this->success('成功','index/test');//也可以单独用此行作为页面跳转
	//}else{
		//$this->error('失败','index/test');
	}






//单独为类建个空操作，防止输错方法
	function _empty(){//如果方法不存在，不会报错，会输出empty此方法的结果
		//return '您访问的方法不存在';
		//$this->redirect('page404');//跳转到page404的方法
		$this->redirect('Error/show');//方法错误跳转到Error类的show方法。Error里面没show方法，Error里面再跳转到其404链接，如果控制器错误跳转到Error里面，然后让它自己再跳转到404页面
	}




//单独建个空控制器，防止输错控制器
	class Error extends Controller{//如果类不存在，会跳到这个方法里面
	public function _empty(){
		$this->redirect('Index/test');
	}
	/*
	每一个线上项目都需要空操作和空控制器
	在每一个控制器中都需要一个空操作
	无论前端还是后端，都需要加一个空控制器


	*/








请求

<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Demo extends Controller{

/*	function index(){
		$r=request();
		dump($r->url());
	}
*/

	function index(Request $r){
		//dump($r);
		//dump($r->url());//此函数跟上面方法效果一样
		//echo $r->ext();//打印伪地址后缀，例如.html
		//dump($r->root());//入口地址
		//dump($r->pathinfo());
		//dump($r->domain());//域名
		//dump($r->ip());
		//dump($r->isAjax());//是否ajax请求
		//dump($r->isGet());
		dump($r->controller());//打印控制器
		//dump($r->action());//打印当前方法名
	}




}












?>
、、、、、、、、、、、、、、、、、、、、、、、、、、、、、、
在当前模版文件中包含其他的模版文件使用include标签

使用模版表达式
{include file="public/header"}
{include file="public/header" /} // 包含头部模版header
{include file="public/menu" /} // 包含菜单模版menu
{include file="blue/public/menu" /} // 包含blue主题下面的menu模版

使用模版文件
{include file="../application/index/view/public/footer.html" /}//相对于index.php入口的

包含多个模板文件（也可以分别写2句代码）
{include file="../application/index/view/public/footer.html,public/header" /}








?>