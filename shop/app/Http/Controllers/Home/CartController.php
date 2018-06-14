<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{

/*	function cartpublic(){

	}*/
    //ajax处理添加购物车和立刻购买

    function cartadd(Request $request){
    	//传来的购买数量
    	$goods_num=$request->input('goods_num');
    	//传来的产品id
    	$goods_id=$request->input('goods_id');
    	//dd($id);
    	//当前用户的id
    	$user_id=$request->session()->get('userid');
    	//通过传来的商品id来找对应的产品信息
    	$goods_info=DB::table('goods')->where('goods_id',$goods_id)->first();
    	//先查询当前的库存数量
    	$goods_inventory=$goods_info->goods_inventory;
    	//判断输入的值是否大于库存
    	$data=[];
    	if($goods_num<=$goods_inventory){
    		//如果不大于库存
    		$data['goods_num']=$goods_num;
    	}else{//如果大于库存，只能存储储存的产品个数
    		$data['goods_num']=$goods_inventory;
    	}

    	//查询目前购物车是否有相同的没付款的产品
    	$cart_current=DB::table('cart')->where('user_id',$user_id)->where('goods_id',$goods_id)->where('cart_status',0)->first();

    	if(!count($cart_current)){//如果购物车里没有相同的产品直接添加数据
	    	//把相关的数据放到数组里面
	    	$data['goods_id']=$goods_id;
	    	$data['goods_name']=$goods_info->goods_name;
	    	$data['goods_photo']=$goods_info->goods_photo;
	    	$data['goods_price']=$goods_info->goods_price;
	    	$data['user_id']=$user_id;
	    	$data['cart_subtotal']=$goods_info->goods_price * $goods_num;
	    	$data['cart_savedate']=date('Y-m-d H:i:s');

	    	//向购物车添加数据
	   		$cart_id=DB::table('cart')->insertGetId($data);
	    	if($cart_id){
	    		return 1;//成功返回1

	    	}else{
	    		return 0;
	    	}

    	}else{
    		//如果购物车此时已经有相同的产品，个数和总计会变化，相当于修改数据
    		$data['goods_num']=$goods_num+$cart_current->goods_num;//已有的加增加的
    		$data['cart_subtotal']=$cart_current->cart_subtotal+$goods_num*$goods_info->goods_price;
    		//此时的增加数据就是更改数据表
    		$res=DB::table('cart')->where('cart_id',$cart_current->cart_id)->update($data);
    		if($res){
    			return 1;//成功返回1
    		}else{
    			return 0;
    		}
    	}


    }
//跟上面函数几乎一样，只是cart_checked值不同，以后可以再优化合并
    function cartaddnow(Request $request){
    	    	//传来的购买数量
    	$goods_num=$request->input('goods_num');
    	//传来的产品id
    	$goods_id=$request->input('goods_id');
    	//dd($id);
    	//当前用户的id
    	$user_id=$request->session()->get('userid');
    	//通过传来的商品id来找对应的产品信息
    	$goods_info=DB::table('goods')->where('goods_id',$goods_id)->first();
    	//先查询当前的库存数量
    	$goods_inventory=$goods_info->goods_inventory;
    	//判断输入的值是否大于库存
    	$data=[];
    	if($goods_num<=$goods_inventory){
    		//如果不大于库存
    		$data['goods_num']=$goods_num;
    	}else{//如果大于库存，只能存储储存的产品个数
    		$data['goods_num']=$goods_inventory;
    	}

    	//查询目前购物车是否有相同的没付款的产品
    	$cart_current=DB::table('cart')->where('user_id',$user_id)->where('goods_id',$goods_id)->where('cart_status',0)->first();

    	if(!count($cart_current)){//如果购物车里没有相同的产品直接添加数据
	    	//把相关的数据放到数组里面
	    	$data['goods_id']=$goods_id;
	    	$data['goods_name']=$goods_info->goods_name;
	    	$data['goods_photo']=$goods_info->goods_photo;
	    	$data['goods_price']=$goods_info->goods_price;
	    	$data['user_id']=$user_id;
	    	$data['cart_subtotal']=$goods_info->goods_price * $goods_num;
	    	$data['cart_savedate']=date('Y-m-d H:i:s');
	    	$data['cart_checked']=1;

	    	//向购物车添加数据
	   		$cart_id=DB::table('cart')->insertGetId($data);
	    	if($cart_id){
	    		return 1;//成功返回1

	    	}else{
	    		return 0;
	    	}

    	}else{
    		//如果购物车此时已经有相同的产品，个数和总计会变化，相当于修改数据
    		$data['goods_num']=$goods_num+$cart_current->goods_num;//已有的加增加的
    		$data['cart_subtotal']=$cart_current->cart_subtotal+$goods_num*$goods_info->goods_price;
    		$data['cart_checked']=1;
    		//此时的增加数据就是更改数据表
    		$res=DB::table('cart')->where('cart_id',$cart_current->cart_id)->update($data);
    		if($res){
    			return 1;//成功返回1
    		}else{
    			return 0;
    		}
    	} 

    }




    //购物车的页面
    function cartlist(Request $request){
    	//当前用户的id
    	$user_id=$request->session()->get('userid');
    	//查询当前购物车所有的没结账的购物信息
    	$res=DB::table('cart')->where('user_id',$user_id)->get();
    	
    	//找到没结账且被选中的信息，以便计算当前选中的总金额
    	$restotal=DB::table('cart')->where('user_id',$user_id)->where('cart_checked',1)->get();
    	$n=0;//选中的个数的初始化为0，循环一次增加一次
    	$total=0;//初始化总金额为0
    	foreach($restotal as $v){
    		$n++;
    		$total+=$v->cart_subtotal;//计算当前的未付款的的总金额

    	}
        $total=number_format($total,2);
    	//dd($total);//把遍历的结果和总金额传过去
    	return view('home.cart.index',['res'=>$res,'total'=>$total,'n'=>$n]);
    }


    //购物车中点击加号和减号的方法处理，处理，里面的金额变化
    function cartup(Request $request){
    	//获得当前id
    	$cart_id=$request->input('cart_id');
    	//当前用户的id
    	$user_id=$request->session()->get('userid');
    	//当前的购物车当条数据信息
    	$res=DB::table('cart')->where('cart_id',$cart_id)->first();
    	//通过传来的商品id来找对应的产品信息
    	$goods_info=DB::table('goods')->where('goods_id',$res->goods_id)->first();
    	$data=[];
    	//点击一次，数量加1
    	//$data['goods_num']=$res->goods_num+1; 
    	//先查询当前的库存数量
    	$goods_inventory=$goods_info->goods_inventory;
    	//判断输入的值是否大于库存    	   	
    	if($res->goods_num+1<=$goods_inventory){
    		//如果不大于库存
    		$data['goods_num']=$res->goods_num+1;
    	}else{//如果大于库存，只能存储储存的产品个数
    		$data['goods_num']=$goods_inventory;
    	}    	

    	//当前个数下的总金额
    	$data['cart_subtotal']=$data['goods_num']*$res->goods_price;    	
    	//数据改变后更新数据库
    	$result=DB::table('cart')->where('cart_id',$cart_id)->update($data);

    	//购物车所有没付款的信息，以便计算总金额
    	$res=DB::table('cart')->where([['user_id',$user_id],['cart_status',0]])->where('cart_checked',1)->get();
    	$total=0;
    	foreach($res as $v){
    		$total+=$v->cart_subtotal;//计算当前的未付款的的总金额

    	}
    	//把总金额，每个产品的总金额都传过去
    	$data['total']=number_format($total,2);
    	if($res){
    		return $data;
    	}else{
    		return 0;
    	}


    	//return json_encode($res);
    }
    //点击减号时
    function cartdown(Request $request){
    	//return 1111;
    	//获得当前id
    	$cart_id=$request->input('cart_id');
    	//当前用户的id
    	$user_id=$request->session()->get('userid');
    	//当前的购物车当条数据信息
    	$res=DB::table('cart')->where('cart_id',$cart_id)->first();
    	//通过传来的商品id来找对应的产品信息
    	$goods_info=DB::table('goods')->where('goods_id',$res->goods_id)->first();
    	//点击一次，数量减1
    	//$data['goods_num']=$res->goods_num+1; 
    	//判断输入的值是否大于库存    	   	
    	if($res->goods_num-1<=1){
    		//如果不大于库存
    		$data['goods_num']=1;
    	}else{
    		$data['goods_num']=$res->goods_num-1;
    	}   
    	//当前个数下的总金额
    	$data['cart_subtotal']=$data['goods_num']*$res->goods_price;    	
    	//数据改变后更新数据库
    	$result=DB::table('cart')->where('cart_id',$cart_id)->update($data);

    	//购物车所有没付款的信息，以便计算总金额
    	$res=DB::table('cart')->where([['user_id',$user_id],['cart_status',0]])->where('cart_checked',1)->get();
    	$total=0;
    	foreach($res as $v){
    		$total+=$v->cart_subtotal;//计算当前的未付款的的总金额

    	}
    	//把总金额，每个产品的总金额都传过去
    	$data['total']=number_format($total,2);
    	if($res){
    		return $data;
    	}else{
    		return 0;
    	}

    }

    //购物车的产品单个删除
    function cartdel(Request $request){
    	$cart_id=$request->input('cart_id');
    	//return $cart_id;
    	//删除操作
    	$res=DB::table('cart')->where('cart_id',$cart_id)->delete();
    	$user_id=$request->session()->get('userid');
    	if($res){
	    	//找到当前购物车所有没付款的，遍历算出总金额
	    	$result=DB::table('cart')->where('user_id',$user_id)->where('cart_status',0)->get();
	    	$total='';
	    	foreach($result as $v){
	    		$total+=$v->cart_subtotal;
	    	}
	    	return number_format($total,2);

    	}else{
    		return 0;
    	}


    }

    //购物车产品批量删除
    function cartlistdel(Request $request){
    	$user_id=$request->session()->get('userid');
    	//得到id和cart_checked对应的数组
    	$res=$request->except('_token');
    	foreach($res as $k=>$v){
    		//提交后先把所有选中的checked变成1，然后对等于1的做删除处理
    		DB::table('cart')->where('cart_id',$k)->update(['cart_checked'=>$v]);
    		DB::table('cart')->where('cart_checked',1)->where('user_id',$user_id)->delete();
    	}
    	//删除成功后再回到当前列表页
	    return redirect('home/cart/cartlist');

    }

    //购物车单个复选框ajax传值，改变是否选中cart_checked,获得id后判断当前数据库中的checked是多少，然后取反改变
    function cart_onechecked(Request $request){
        $user_id=$request->session()->get('userid');
        $cart_id=$request->input('cart_id');
        $checked=DB::table('cart')->where('cart_id',$cart_id)->value('cart_checked');
        //判断数据库中checked的值
        if($checked==0){
            $cart_checked=1;
        }else{
            $cart_checked=0;
        }
        //更改checked的值
        $res=DB::table('cart')->where('cart_id',$cart_id)->update(['cart_checked'=>$cart_checked]);
        //找到没结账且被选中的信息，以便计算当前选中的总金额
        $restotal=DB::table('cart')->where('cart_status',0)->where('user_id',$user_id)->where('cart_checked',1)->get();
        $n=0;//选中的个数的初始化为0，循环一次增加一次
        $total=0;//初始化总金额为0
        foreach($restotal as $v){
            $n++;
            $total+=$v->cart_subtotal;//计算当前的未付款的的总金额

        }
        if($res){
            return 1;
        }else{
            return 0;
        }
       
    }

    //购物车全选时
    function cart_checkedall(Request $request){
        $user_id=$request->session()->get('userid');

        $result=DB::table('cart')->where('user_id',$user_id)->get();
        $m=1;//初始化
        foreach($result as $v){
             $m*=$v->cart_checked;
        }
        //等于1说明都已经是选中的了需要变成都没选中的
        if($m==1){
            $res=DB::table('cart')->where('user_id',$user_id)->update(['cart_checked'=>0]);
            if($res){
                return 1;
            }else{
                return 0;
            }

        }else{
            $res=DB::table('cart')->where('user_id',$user_id)->update(['cart_checked'=>1]);
            if($res){
                return 1;
            }else{
                return 0;
            }
        }
    }





}
