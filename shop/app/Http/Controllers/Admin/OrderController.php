<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
    //后台的订单页列表
    function orderlist(){
    	//return 1111;
    	$res=DB::table('order')->orderBy('order_id','desc')->paginate(10);
    	return view('admin.order.orderlist',['res'=>$res]);

    }

    //改变订单状态，通过ajax点击传来的值
    function order_statuschange(Request $request){
        $order_id=$request->input('order_id');
    	$order_status=$request->input('order_status');

    	//return $order_id;
        if($order_status==1){
            //获得id值后进行状态更改，变成已发货
            $res=DB::table('order')->where('order_id',$order_id)->update(['order_status'=>2]);
            if($res){
                return 1;
            }else{
                return 0;
            }            
        }elseif($order_status==2){//
            $res=DB::table('order')->where('order_id',$order_id)->update(['order_status'=>3]);
            if($res){
                return 1;
            }else{
                return 0;
            }

        }


    }

    //后台订单的订单详情
    function orderdetails($id){
    
        //dd($order_id);
        $res=DB::table('order_details')->where('order_id',$id)->get();
        $result=DB::table('order')->where('order_id',$id)->first();
        return view('admin.order.orderdetails',['res'=>$res,'result'=>$result]);
    }




}
