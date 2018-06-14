<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Orderlist extends Model
{
    //前台的订单列表页
    function orderlist($user_id){
    	
        $res=DB::table('order')->where('user_id',$user_id)->orderBy('order_id','desc')->paginate(6);
    	//$res=DB::table('order')->where('user_id',$user_id)->orderBy('order_id','desc')->get();
    	return $res;
    }
    //取消订单时更改状态，0变成5
    function updateorder($id){

    	$res=DB::table('order')->where('order_id',$id)->update(['order_status'=>5]);
    	return $res;    
    }
    //点击确认收货变成评价，状态3变成4
    function updateorder1($request,$id){
    	//$userid=$request->session()->get('userid');
    	$data=[];
    	$data['order_status']=4;
    	$data['order_donedate']=date('Y-m-d H:i:s');
    	//执行订单状态改成已收货，去评价
    	$res=DB::table('order')->where('order_id',$id)->update($data);
    	$details=DB::table('order_details')->where('order_id',$id)->get();
    	$sales=[];
    	foreach($details as $v){
    		//当前商品的销量
    		$goods_sales=DB::table('goods')->where('goods_id',$v->goods_id)->value('goods_sales');
    		//已卖产品数量
    		$goods_sales=$goods_sales+$v->goods_num;
    		//当前商品应该有的销量
    		$sales=['goods_sales'=>$goods_sales];
    		//更改商品的销量
    		DB::table('goods')->where('goods_id',$v->goods_id)->update($sales);
    	}
    	return $res; 
    }

    function ordershow($id){
    	$orderres=DB::table('order')->where('order_id',$id)->first();
    	return $orderres;
    }

    function orderlistshow($id){
    	$orderlistres=DB::table('order_details')->where('order_id',$id)->get();
    	return $orderlistres;
    }
}
