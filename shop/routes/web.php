<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//后台的路由
//后台登录
Route::get('admin/login/index','Admin\LoginController@index');
Route::post('admin/login/login','Admin\LoginController@login');
Route::get('admin/login/out','Admin\LoginController@out');

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'adminlogin'],function(){
	//后台主页
	Route::get('index/index','IndexController@index');
	//用户的资源路由
	Route::resource('user','UserController');
	//用户处理头像缩略图的路由
	Route::post('userthumb/user_thumb','UserController@user_thumb');
	//产品分类路由
	Route::resource('cate','CateController');
	//产品路由
	Route::resource('goods','GoodsController');
	//添加产品里面下拉菜单的路由
	Route::post('goodselect/createselect','GoodsController@createselect');
	//主分类广告大图
	Route::get('catepic/cate_pic','CateController@cate_pic');
	//主分类广告大图添加
	Route::post('catepic/cate_picadd','CateController@cate_picadd');
	//主分类广告大图删除
	Route::get('catepic/cate_picdel','CateController@cate_picdel');
	//处理分类主体的排序，设定分类主体
	Route::get('catepic/cate_picsort/{id}','CateController@cate_picsort');

	//角色管理
	Route::resource('role','RoleController');
	//权限管理
	Route::resource('permission','PermissionController');
	//给角色组权限分配
	Route::get('roles/perm_assign/{id}','RoleController@perm_assign');
	//执行权限分配
	Route::post('roles/doassign','RoleController@doassign');




	//产品图片管理的路由
	Route::get('goodspic/goods_picmana/{id}','GoodsController@goods_picmana');
	//单独删除图片的路由
	Route::get('goodspic/goods_picdel','GoodsController@goods_picdel');
	//单独添加图片的路由
	Route::post('goodspic/goods_picadd/{id}','GoodsController@goods_picadd');
	//单独产品图片的排序
	Route::post('goodspic/goods_picsort/{id}','GoodsController@goods_picsort');

	//单独添加产品介绍页面的路由
	Route::get('goodsintro/goods_intro/{id}','GoodsController@goods_intro');
	//单独添加产品介绍的路由
	Route::post('goodsdointro/goods_dointro/{id}','GoodsController@goods_dointro');

	//后台的订单列表路由
	Route::get('order/orderlist','OrderController@orderlist');
	//点击订单状态时改变数据库订单状态
	Route::get('order/order_statuschange','OrderController@order_statuschange');
	//订单详情
	Route::get('order/orderdetails/{id}','OrderController@orderdetails');

	//产品评论管理
	Route::get('comment/index','CommentController@index');




});
//Route::get('home/mail/sendmail','Home\MailController@sendmail');
//前台的路由
//注册页面
Route::get('home/reg/reg','Home\RegController@reg');
//注册时处理短信验证码的路由
Route::get('home/reg/getcode','Home\RegController@getcode');
//注册提交处理的路由
Route::post('home/reg/doreg','Home\RegController@doreg');


//登录页面
Route::get('home/login/login','Home\LoginController@login');
//验证登录的操作的路由
Route::post('home/login/dologin','Home\LoginController@dologin');
//忘记密码
Route::get('home/login/forgetpass','Home\LoginController@forgetpass');
//忘记密码的，检测验证码
Route::post('home/login/docheckpass','Home\LoginController@docheckpass');
//忘记密码，发送验证码之后，点击下一步的操作路由
Route::post('home/login/donextcheckpass','Home\LoginController@donextcheckpass');
//忘记密码后的重置密码
Route::post('home/login/changepass','Home\LoginController@changepass');
//退出登录
Route::get('home/login/logout','Home\LoginController@logout');


Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
	//前台的主页
	Route::get('home/index','HomeController@index');
	//前台产品详情页
	Route::get('goodsdetail/index/{id}','GoodsDetailController@index');
	//前台产品分类页
	Route::get('category/index/{id?}','CategoryController@index');	

	//产品分类里面，点击顶级分类后处理的路由
	Route::get('category/cateclick','CategoryController@cateclick');


});
//关于购物车和订单的
Route::group(['prefix'=>'home','namespace'=>'Home','middleware'=>'homelogin'],function(){
	//处理添加至购物车的路由
	Route::post('cart/cartadd','CartController@cartadd');
	//处理立刻购买的路由
	Route::post('cart/cartaddnow','CartController@cartaddnow');
	//购物车页面的路由
	Route::get('cart/cartlist','CartController@cartlist');
	//立刻购买
	Route::get('cart/buynow','CartController@buynow');
	//点击购物车里面的加号增加个数时的路由，金额和产品数量发生变化
	Route::post('cart/cartup','CartController@cartup');
	//点击购物车里面的加号增加个数时的路由，金额和产品数量发生变化
	Route::post('cart/cartdown','CartController@cartdown');
	//点击删除的时候
	Route::post('cart/cartdel','CartController@cartdel');
	//点击按钮批量删除的时候
	Route::post('cart/cartlistdel','CartController@cartlistdel');
	//点击购物车复选框中的一个让checked发生改变
	Route::post('cart/cart_onechecked','CartController@cart_onechecked');
	//点击购物车复选框里面的全选时的路由
	Route::post('cart/cart_checkedall','CartController@cart_checkedall');


	//购物车提交订单，订单生成
	Route::post('order/doorder','OrderController@doorder');
	//订单确认支付页面
	Route::get('order/orderpay/{id}','OrderController@orderpay');
	//执行付款，修改订单状态，订单表加上收件人信息
	Route::get('order/doorderpay/{id}','OrderController@doorderpay');


	//个人中心，收货地址页面路由
	Route::get('personal/peraddress','PersonalController@peraddress');
	//ajax传值获得省市信息的
	Route::post('personal/ajaxgetarea','PersonalController@ajaxgetarea');
	//添加收货地址信息的方法路由
	Route::post('personal/addaddress','PersonalController@addaddress');
	//删除收货地址信息的方法路由
	Route::get('personal/addressdel','PersonalController@addressdel');
	//更改地址
	Route::get('personal/addressupdate/{id}','PersonalController@addressupdate');
	//执行更改地址
	Route::post('personal/addr_doupdate','PersonalController@addr_doupdate');
	//更改默认地址
	Route::get('personal/addr_default','PersonalController@addr_default');
	//更改登录密码
	Route::get('personal/changepwd','PersonalController@changepwd');
	//改密第一步
	Route::get('personal/changepwd_step1','PersonalController@changepwd_step1');
	//改密第二步
	Route::post('personal/changepwd_step2','PersonalController@changepwd_step2');
	//执行第二步跳转第三步
	Route::get('personal/dochangepwd_step2','PersonalController@dochangepwd_step2');
	//改密第三步
	Route::post('personal/changepwd_step3','PersonalController@changepwd_step3');







	//订单中心，订单列表页
	Route::get('order/orderlist','OrderController@orderlist');
	//前台的订单中心页面
	Route::resource('orderlist','OrderlistController');
	////点击确认收货变成去评价
	Route::post('orderlist1/update1/{id}','OrderlistController@update1');
	//评论页面
	Route::get('orderlist1/comment/{id}','OrderlistController@comment');
	//执行评论添加
	Route::post('orderlist1/docomment/{id}','OrderlistController@docomment');

	

	

});
