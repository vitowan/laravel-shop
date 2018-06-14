<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
    //购物车提交订单，生成订单和订单详情
    function doorder(Request $request){
		//当前用户
        $user_id=$request->session()->get('userid');
        $goods=DB::table('cart')->where('user_id',$user_id)->where('cart_checked',1)->get();
        //购物车找到当前提交的商品,可能是多个
        if(count($goods)){
            $order_total=0;
            foreach($goods as $v){
                $order_total+=$v->goods_price*$v->goods_num;
            }
            $order_code=date('YmdHis').rand(1,999999);
            $order_date=date('Y-m-d H:i:s');
            $order=[];
            $order['user_id']=$user_id;
            $order['order_code']=$order_code;
            $order['order_total']=$order_total;
            $order['order_date']=$order_date;


            //添加数据到order订单表
            $order_id=DB::table('order')->insertGetId($order);
            //再添加订单详情
            if($order_id){
                foreach($goods as $v){
                    //分别获得每条数据信息，再分别添加
                    $order_details['goods_name']=$v->goods_name;
                    $order_details['goods_photo']=$v->goods_photo;
                    $order_details['goods_price']=$v->goods_price;
                    $order_details['goods_num']=$v->goods_num;
                    $order_details['order_subtotal']=$v->cart_subtotal;
                    $order_details['order_id']=$order_id;
                    $order_details['goods_id']=$v->goods_id;
                    //为每条数据执行添加到订单详情表操作
                    DB::table('order_details')->insertGetId($order_details);

                    //更改商品表goods表里面的库存
                    $goods_inventory=DB::table('goods')->where('goods_id',$v->goods_id)->value('goods_inventory');
                    $inventory=$goods_inventory-$v->goods_num;
                    //先计算出准确的库存后再更改
                    $data['goods_inventory']=$inventory;
                    DB::table('goods')->where('goods_id',$v->goods_id)->update($data);

                }
                //再删除购物车里对应的商品
               $result= $res=DB::table('cart')->where('user_id',$user_id)->where('cart_checked',1)->delete();
               if($result){
                    return redirect('home/order/orderpay'.'/'.$order_id);
                
               }else{
                    return back();
               }

            }

        }else{
            return back();
        }

    }

    ////订单确认支付页面
     function orderpay(Request $request,$id){
     	//当前用户
        $user_id=$request->session()->get('userid');
        	//得到所有的当前的地址信息
        $address=DB::table('address')->where('user_id',$user_id)->get();
        //找到对应订单id的订单
        $result=DB::table('order_details')->where('order_id',$id)->get();
        $total=0;
        foreach($result as $v){
        	$total+=$v->order_subtotal;//等待付的总金额
        }
        //得到当前的订单信息，然后分配到模板用
        $res=DB::table('order')->where('order_id',$id)->first();

        return view('home.order.orderpay',['address'=>$address,'result'=>$result,'total'=>$total,'res'=>$res]);
    }

    //提交订单支付，成功后，更改订单状态order_status 和收件人信息
    function doorderpay(Request $request,$id){
    	$address_id=$request->input('address_id');
        $pay_method=$request->input('pay_method');
        //return $address_id;判断地址
        if($address_id){
            //如果大于0.说明选了地址
            $address_detail=DB::table('address')->where('address_id',$address_id)->value('address_detail');
            $receiver_tel=DB::table('address')->where('address_id',$address_id)->value('receiver_tel');
            $receiver_name=DB::table('address')->where('address_id',$address_id)->value('receiver_name');
        }else{//此时说明是默认地址，需要找到默认的地址信息
            $address=DB::table('address')->where('address_default',1)->first();
            $address_detail=$address->address_detail;
            $receiver_tel=$address->receiver_tel;
            $receiver_name=$address->receiver_name;
        }
        //判断当前的存款方式
        if($pay_method==1){
            $pay_method=1;//点击了支付宝
        }else if($pay_method==2){
            $pay_method=2;//点击了微信
        }else{
            $pay_method=1;//没点击默认支付宝
        }
        //订单表需要更改的一些信息
        $order_paydate=date('Y-m-d H:i:s');
        $order=[];
        $order['order_paydate']=$order_paydate;
        $order['pay_method']=$pay_method;
        $order['order_status']=1;
        $order['address_detail']=$address_detail;
        $order['receiver_name']=$receiver_name;
        $order['receiver_tel']=$receiver_tel;
        //更改order表中的数据
        $res=DB::table('order')->where('order_id',$id)->update($order);
        if($res){
        	return 1;
        }else{
        	return 0;
        }



    }







}
