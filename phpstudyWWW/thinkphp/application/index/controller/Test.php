<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
//use think\Model;
//use app\index\model;
use app\index\model\User;
use think\Loader;
class Test extends Controller{
	function index(){
		//查询
		$user=new \app\index\model\User();
		//dump($user::get(1)->toArray());
		//dump($user::get(1));
		//dump($user);
		//$user=new model\User();


		//$user=new User();


		//$user=Loader::model('User');
		//dump($user);
		//dump($user::get(1)->toArray());
		//dump($user::get(['username'=>'12'])->toArray());
		//$arr=$user::all();
		//$arr=$user::all('1,2');
		//$arr=$user::all([1,2]);
		//dump($arr);
		//$arr=$user::all(1);
		//$arr=$user::all(['username'=>'123']);
		//$arr=$user::all(['username'=>'123','password'=>'12345612']);
		//$arr=$user::select();//等价$user::all()
		//$arr=$user::limit(0,1)->select();
		//dump($arr);

		//foreach($arr as $v){
		//	dump($v->toArray());
		//}
		//$a=$user::where('id','2')->value('username');//等同select name from user where id=2;
		//dump($a);

		//$arr=$user::column('id');
		//$arr=$user::column('id,username');
		//$arr=$user::column('id,username,password');
		//dump($arr);

		//$arr=$user::getByUsername('123');
		//$arr=$user::getByUsername('123')->toArray();
		//dump($arr);

		$a=$user::count();//总的个数
		$a=$user::max('id');//最大id值
		$a=$user::min('id');//最小id值
		$a=$user::avg('id');//平均值
		$a=$user::sum('id');//总和值
		$a=$user::where('id','>','3')->sum('id');
		$a=$user::where('id','>','3')->max('id');

		echo $a;

		//新增
		
/*		$user=new User();
		$user->username='eric';
		$user->password='123';
		$user->save();*/

/*		$user=new User();
		//$user->data(['username'=>'wan','password'=>'123']);
		$arr=['username'=>'wang','password'=>'123'];
		$user->data($arr);
		$user->save();*/

/*		$user=new User();
		$arr=['username'=>'wa','password'=>'123'];
		$user->save($arr);*/

		//$user=new User();
		//$arr=['username'=>'zhang','password'=>'123','id=>10'];
		//$user->allowfield(true)->save($arr);









	}
}





?>