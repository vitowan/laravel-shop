<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Hash;
class PersonalController extends Controller
{
	//ajax处理城市下来菜单的方法
	function ajaxgetarea(Request $request){
		$pid=$request->input('pid');

		$res=DB::table('rc_district')->where('pid',$pid)->get();
		return $res;		
       
	}
	 //收货地址页面
    function peraddress(Request $request){
    	//城市下拉菜单得到省份信息
		$province=DB::table('rc_district')->where('pid',1)->get();
		$user_id=$request->session()->get('userid');
		//得到所有的当前的地址信息
		$result=DB::table('address')->where('user_id',$user_id)->get();

    	return view('home.personal.peraddress',['province'=>$province,'result'=>$result]);
    }

    //添加收货地址的方法
    function addaddress(Request $request ){
    	//$res=$request->input();
//城市下拉菜单得到省份信息
		$province=DB::table('rc_district')->where('pid',1)->get();
    	$res=$request->only(['receiver_name','receiver_tel']);
    	//得到user_id
		$user_id=$request->session()->get('userid');
		$res['user_id']=$user_id;
		//通过获得的城市地区的id号，得到名字
		$province=DB::table('rc_district')->where('district_id',$request->input('province'))->value('district');
		$city=DB::table('rc_district')->where('district_id',$request->input('city'))->value('district');
		$area=DB::table('rc_district')->where('district_id',$request->input('area'))->value('district');

		$details=$request->input('details');
		//拼接详细地址
		$res['address_detail']=$province.' '.$city.' '.$area.' '.$details;
		$address_default=$request->input('address_default');
		if($address_default==1){
			$res['address_default']=1;
			$address_id=DB::table('address')->where('address_default',1)->where('user_id',$user_id)->value('address_id');
			//return $address_id;把之前默认的改为不默认的
			DB::table('address')->where('address_id',$address_id)->update(['address_default'=>0]);

		}else{
			$res['address_default']=0;
		}

    	//插入数据
		$id=DB::table('address')->insertGetId($res);
		if($id){
			return redirect('home/personal/peraddress');
		}else{
			return '发生了错误';
		}
    	
    }
    //删除地址
    function addressdel(Request $request){
		$address_id=$request->input('address_id');
		//return $address_id;
		$res=DB::table('address')->where('address_id',$address_id)->delete();
		if($res){
			return 1;
			
		}else{
			return 0;
		}
	}


	//修改地址
	function addressupdate(Request $request,$id){
		$province=DB::table('rc_district')->where('pid',1)->get();
		$user_id=$request->session()->get('userid');
		//得到所有的当前的地址信息
		$result=DB::table('address')->where('user_id',$user_id)->get();
		$res=DB::table('address')->where('address_id',$id)->first();

		return view('home.personal.address_edit',['province'=>$province,'result'=>$result,'res'=>$res]);
	}

	//执行修改地址信息
	function addr_doupdate(Request $request){
		//return 111;
		//得到user_id
		$address_id=$request->input('address_id');
		$user_id=$request->session()->get('userid');
		$res=$request->only(['receiver_name','receiver_tel']);
		$res['user_id']=$user_id;
		//通过获得的城市地区的id号，得到名字
		$province=DB::table('rc_district')->where('district_id',$request->input('province'))->value('district');
		$city=DB::table('rc_district')->where('district_id',$request->input('city'))->value('district');
		$area=DB::table('rc_district')->where('district_id',$request->input('area'))->value('district');
		$details=$request->input('details');
		//拼接详细地址
		$res['address_detail']=$province.' '.$city.' '.$area.' '.$details;
		$address_default=$request->input('address_default');
		if($address_default==1){
			$res['address_default']=1;
			$address_id=DB::table('address')->where('address_default',1)->where('user_id',$user_id)->value('address_id');
			//return $address_id;把之前默认的改为不默认的
			DB::table('address')->where('address_id',$address_id)->update(['address_default'=>0]);

		}else{
			$res['address_default']=0;
		}
		//dd($res);

		//更改数据操作
		$r=DB::table('address')->where('address_id',$address_id)->update($res);
		if($r!==false){
			return redirect('home/personal/peraddress');
		}else{
			return back();
		}

	}



	//更改默认地址
	function addr_default(Request $request){
		//return 1111;
		$user_id=$request->session()->get('userid');
		//return $user_id;
		$get_address_id=$request->input('address_id');
		$address_id=DB::table('address')->where('address_default',1)->where('user_id',$user_id)->value('address_id');
		//return $address_id;//把之前默认的改为不默认的
		if($address_id){
			$res=DB::table('address')->where('address_id',$address_id)->update(['address_default'=>0]);
			if($res){//把当前点击的改为默认的
				$result=DB::table('address')->where('address_id',$get_address_id)->update(['address_default'=>1]);
				if($result){
					return 1;
				}else{
					return 0;
				}

			}else{
				return 0;
			}

		}else{
			$result=DB::table('address')->where('address_id',$get_address_id)->update(['address_default'=>1]);
			if($result){
				return 1;
			}else{
				return 0;
			}
		}

	}

	//更改登录密码
	function changepwd(){
		return view('home.personal.changepwd');
	}
	//改密第一步
	function changepwd_step1(){
		return view('home.personal.changepwd_step1');
	}
	//改密第二步
	function changepwd_step2(Request $request){
		//dd(11);
		$user_id=$request->session()->get('userid');
		$pass=DB::table('user')->where('id',$user_id)->value('pass');
		$password=$request->input('password');
		//dd($res);
		if(Hash::check($password,$pass)){
			return redirect('home/personal/dochangepwd_step2');
		}else{
			return back()->with('mes2','原密码与登录密码不匹配');
		}
		
		

		//return view('home.personal.changepwd_step3');
	}

	//执行更改密码第二步
	function dochangepwd_step2(){
		return view('home.personal.changepwd_step2');
	}
	//改密第三步
	function changepwd_step3(Request $request){
		//dd(11);
		$user_id=$request->session()->get('userid');
		$password=$request->input('password');
		$repassword=$request->input('repassword');
		//dd($repassword);
		if($repassword==$password){
			//改密码
			$res['password']=$password;
			$res['pass']=Hash::make($request->input('password'));
    		$result=DB::table('user')->where('id',$user_id)->update($res);
			return view('home.personal.changepwd_step3');
		}else{
			return back()->with('mes2','两次输入的密码不匹配');
		}

		
	}

}
