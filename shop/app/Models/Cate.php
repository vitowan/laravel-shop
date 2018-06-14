<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Cate extends Model
{
        //对类别递归，递归得到一个多层级的大数组
    function cate_arrlist($data,$pid=0){
        $arr=[];
        foreach($data as $k=>$v){
            if($v->cate_pid==$pid){//当id值跟传来的pid值相等时，添加一个child属性，把子集放里面，最后结果会一层层的child显示
                $v->child=$this->cate_arrlist($data,$v->id);
                //把每次递归遍历的集合放到数组里面
                $arr[]=$v;
            }
        }
        return $arr;
    }



	//对类别，递归把父级盒子级排到一起，得到有个二维数组
	function cate_list($data,$pid=0,$level=1){
		//对于再次调用时，它在函数外面，因此要全局
    	global $arr;
    	foreach($data as $k=>$v){
    		//dd($v);
    		if($v->cate_pid==$pid){
    			//加个层级
    			$v->level=$level;
    			//$v->str=str_repeat('————',$v->level-1);
    			//拼接横线
    			$str=str_repeat('————  ',$v->level-1);
    			//拼接带横线的名字
    			$v->cate_strname=$str.$v->cate_name;
    			//每次循环把拼接好的数组放到大数组里面
    			$arr[]=$v;
    			//递归调用函数
    			$this->cate_list($data,$v->id,$level+1);
    		}
    	}
    	return $arr;
	}
    //产品类别
    function getAll($request){
    	$search=$request->input('search');
    	$res=DB::table('cate')->where('cate_name','like','%'.$search.'%')->get();
        return $res;
    	//调用上面的递归函数

    	//$arr=$this->cate_list($res);
    	//return $arr;

    }
    //添加分类
    function inserts($request){
    	$res=$request->except('_token');
    	$result=DB::table('cate')->insertGetId($res);
    	return $result;
    }
    //删除分类
    function del($id){
    	$res=DB::table('cate')->where('cate_pid',$id)->first();
        $res1=DB::table('goods')->where('goods_pid',$id)->first();
    	//return $res;

   		if($res==null && $res1==null){
    		$result=DB::table('cate')->where('id',$id)->delete();
    		if($result){
    			return 1;
    		}else{
    			return 2;
    		}
    	}else{
    		return 0;
    	}
    }
    //更改分类
    function editor($id){
    	$res=DB::table('cate')->where('id',$id)->first();
    	return $res;
    }
    //处理更改分类
    function doupdate($request, $id){
    	$res=$request->only(['cate_name','cate_pid']);

    	$result=DB::table('cate')->where('id',$id)->update($res);
    	return $result;

    	//
    }
}
