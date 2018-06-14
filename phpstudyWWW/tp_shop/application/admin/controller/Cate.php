<?php
namespace app\admin\controller;
use think\Db;
use app\admin\model;
//use think\Paginator;
use think\Page;
class Cate extends \think\Controller{

    //商品分类列表
    public function cateList(){

        //dump($p);die;
        //dump($p->show());
        //dump($p);die;
    	$result=DB::table('cate')->order('id','asc')->select();
    	//dump($result);
    	$cate_list=new model\Cate();
        //调用model类得到全部后代组成的数组
    	$arr=$cate_list->cate_list($result);

       //得到当前传来的get方式传来的页码
        $p=input('p')?input('p'):1;       
        $page = new Page(count($arr),10);
        //dump($page);die;
        $arr=array_slice($arr,($p-1)*10,10);

        $html=$page->show();
        //dump($arr);die;
        $this->assign('arr',$arr);
        $this->assign('html',$html);
    	return view('cate/cate_list');
    }

    //添加商品分类
    function cateAdd(){
        $result=DB::table('cate')->select();
        //dump($result);
        $cate_list=new model\Cate();
        $arr=$cate_list->cate_list($result);
        $this->assign('arr',$arr);
        return view('cate/cate_add');
    }

    //处理添加商品分类
    function doCateAdd(){
       $result=DB::table('cate')->insert($_POST);
       if($result){
            $this->success('添加成功','cate/cateList');
       }else{
            $this->error('添加失败','cate/cateAdd');
       }
    }

    //删除商品分类
    function cateDel($id){
        //dump($id);die;
        //return $_POST['id'];
        //$id=$_POST['id'];
        $res=DB::table('cate')->select($id);
       $result=DB::table('cate')->select();
        //$result=DB::table('cate')->where('pid',$_POST['id'])->select();
        $cate_list=new model\Cate();
         //调用model类得到全部后代组成的数组
        $arr=$cate_list->cate_list($result,$id);
        //dump($arr);die;
        $arr=$res;
//dump($arr);die;

        foreach ($arr as $k =>$v){
          DB::table('cate')->where('id',$v['id'])->delete();

        }
        $this->redirect('cate/cateList');    

    }

    //商品分类更新
    function cateUpd($id){
       // dump($id);die;
        //得到当前的id对应数据
        $res=DB::table('cate')->select($id);

        $result=DB::table('cate')->select();
        //dump($res);die;
        $cate_list=new model\Cate();
        //得到所有的分类组成的数组
        $arr=$cate_list->cate_list($result);
        $this->assign('arr',$arr);
        $this->assign('res',$res);
        return view('cate/cate_upd');
    }
    //商品更新的处理
    function doCateUpd(){
        //dump($_POST);die;
        $arr=array('name'=>$_POST['name'],'pid'=>$_POST['pid']);

        $result=DB::table('cate')->where('id',$_POST['id'])->update($arr);
        //$result=DB::table('cate')->update($_POST);
        if($result!==false){
            $this->success('更改成功','cate/cateList');
        }else{
            $this->error('更改失败','cate/cateList');
        }


    }

    //商品分类的排序
    function cateSort(){
        //dump($_POST);
        foreach($_POST as $k=>$v){
            //dump($v);
            DB::table('cate')->where('id',$k)->update(['sid'=>$v]);
        }
        $this->redirect('cate/cateList');
    }





}
