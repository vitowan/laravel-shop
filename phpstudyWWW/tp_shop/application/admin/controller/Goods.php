<?php
namespace app\admin\controller;
use think\Db;
use app\index\model;
use think\File;
use think\Session;
use think\Page;
class Goods extends \think\Controller{
	//添加商品页面
	function goodsAdd(){

		$result=DB::table('cate')->order('sid','asc')->select();
		$cate_list=new \app\index\model\Cate();
    	$result=$cate_list->cate_list($result);
    	//dump($result);die;
    	//第一级下拉菜单显示传值
    	$this->assign('result',$result);
		return view('goods/goods_add');
	}

	//选择产品分类的下拉菜单
	function cateSelect(){

    	//echo $_POST['pid'];
    	//$area=Cache::get('area_'.$_POST['pid']);
    	//if(!$area){
     		$area = DB::table('cate')->field('id,name')->where('pid',$_POST['pid'])->select();   
     		//Cache::set('area_'.$_POST['pid'],$area); 		
    	//}
    	//dump($area);die;
        return $area;
    	//echo json_encode($area);
	}

	//添加商品时，选择图片后的处理
	function goods_thumb(){
		//替换时先删除之前的图片
		if(session('goods_thumb')){
			$goods_thumb=session('goods_thumb');
			$url=session('url');
			//dump($goods_thumb);die;
			unlink('..'.DS.'uploads'.DS.$url);//只能用相对路径，相对入口文件的
			session('goods_thumb',null);
			session('url',null);
			
		}
		//Session::delete('goods_thumb');
		$file = request()->file('file_data');//里面的名字跟ajax传来的变量一样	
    // 移动到框架应用目录ROOT_PATH/uploads/ 目录下
    	$info = $file->move( ROOT_PATH."uploads");
    	//dump($info);die;
    	 $url=$info->getsaveName();//时间+文件名
    	// $goods_thumb="/tp_shop/uploads/".$url;//拼接成html文档里能显示的路径
    	 if($info){
     	 	$goods_thumb=DS.'tp_shop'.DS.'uploads'.DS.$url;//拼接成html文档里能显示的路径   	 	
    	 	Session::set('goods_thumb',$goods_thumb);
    	 	Session::set('url',$url);
    	 	//echo session::get('goods_thumb');
 			return $goods_thumb;
    	}else{
        // 上传失败获取错误信息
        	echo $file->getError();
    	}

	}


	//处理添加商品
	function doGoodsAdd(){
		//Session::delete('goods_thumb');
		//dump($_POST);
		//dump($_FILES);
		$goods_thumb=Session::get('goods_thumb');
		$post=$_POST;
		//把缩略图路径放到数组里面
		$post['goods_thumb']=$goods_thumb;

		//dump($post);die;
		$result=DB::table('goods')->insert($post);
		if($result){
			session('goods_thumb',null);
			session('url',null);
			$this->success('添加成功',"goods/goodsAdd");
			

		}else{
			$this->error('添加失败',"goods/goodsAdd");
		}

	}
	//产品列表
	function goodsList(){
		//$result=DB::table('goods')->select();
		$goods=new \app\admin\model\Goods();
		$res=$goods->select();
		//实例化页码类，第一个参数是总条数，第二个是每页显示的条数
		$page = new Page(count($res),5);
		//dump($page);die;
		//获取get传来的第几页
		$p=input('p')?input('p'):1;
		$result=$goods::limit(($p-1)*5,5)->select();
		//dump($result);die;
		//调用前端页面
		$html=$page->show();
		$this->assign('result',$result);
		$this->assign('html',$html);//渲染到前端
		return view('goods/goods_list');
	}

	//删除产品
	function goodsDel($id){
		//return 1111;

		$result=DB::table('goods')->delete($id);
		if($result){
			$this->success('删除成功','goods/goodsList');

		}
	}

	//更新产品
	function goodsUpd(){
		//下拉框的第一级查找
		$id=input('id');
		$result=DB::table('cate')->order('sid','asc')->select();
		$cate_list=new \app\index\model\Cate();
    	$result=$cate_list->cate_list($result);
    	//通过id找到当前是哪条数据
    	$res=DB::table('goods')->find($id);
    	//第一级下拉菜单显示传值,一次传多个值
    	//dump($res);die;
    	$res1=DB::table('cate')->find($res['goods_pid']);
    	$res2=DB::table('cate')->find($res1['pid']);
    	$res3=DB::table('cate')->find($res2['pid']);

    	//$this->assign(['result'=>$result,'res'=>$res,'res1'=>$res1,'res2'=>$res2]);
    	$this->assign('result',$result);
    	$this->assign('res',$res);
    	$this->assign('res1',$res1);
    	$this->assign('res2',$res2);
    	$this->assign('res3',$res3);
		return view('goods/goods_upd');
	}

	function doGoodsUpd(){
		//dump($_POST);die;
		//dump($_POST['goods_id']);die;
		$result=DB::table('goods')->where('goods_id',$_POST['goods_id'])->update($_POST);
		if($result!==0){
			$this->success('更改成功','goods/goodsList');
		}else{
			$this->error('更改失败','goods/goodsUpd');
		}
	}








}









?>