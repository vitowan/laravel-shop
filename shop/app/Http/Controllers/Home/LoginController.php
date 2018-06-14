<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
class LoginController extends Controller
{
    //注册页面的方法
    function login(){

    	return view('home.login.index');
    }

    //登录验证
    function dologin(Request $request){
    	//return 111;
    	$string=$request->input('string');
    	//dd($string);
    	$result=DB::table('user')->where([
            ['username',$string],
            ['group_id','110']
        ])->orWhere('phone',$string)->first();
        if(count($result)){
                //dd($result);
            if(Hash::check($request->input('password'),$result->pass)){

                session(['username'=>$result->username,'userid'=>$result->id]);
                //session(['string'=>$string);
                return redirect('home/home/index');
            }else{
                return back()->with('mes','账号或密码错误');
            }        
        }else{
            return back();
        }


    }
    //忘记密码
    function forgetpass(){

    	return view('home/login/forgetpass');
    }
    //忘记密码，发送验证码
    function docheckpass(Request $request){
    	$usercheck=$request->input('usercheck');
    	//查询输入的账号是否是数据库中的
    	$check=DB::table('user')->where('username',$usercheck)->orWhere('phone',$usercheck)->first();
    	if($check){
    		//如果有账号
    		$code=rand(1001,9999);

	    	\Cookie::queue('code',11,1);
	    	session(['username'=>$check->username]);
	    	return 1;
	    	
	    	//return 0;
	    	//return public_path().'\app_config.php';

	/*   		require public_path().'\submail\app_config.php';   

		    require_once(public_path().'\submail\SUBMAILAutoload.php');

		    $submail=new MESSAGEXsend($message_configs);

		    $submail->setTo($phone);
		    
		    $submail->SetProject('mjHdf3');
		    //增加发送的验证码变量
		    $submail->AddVar('code',$code);
		    //增加提示的时间变量
		    $submail->AddVar('time',60);

		    $xsend=$submail->xsend();
		    
		    //print_r($xsend);
		    //return $xsend['status'];
		    if($xsend['status']=='success'){
		    	//\Cookie::queue('code',$code,1);
		    	return 1;
		    }else{
		    	return 0;
		    }*/

    	}else{
    		return 2;
    	}

    }
    ////忘记密码，发送验证码之后，点击下一步的操作事件
    function donextcheckpass(Request $request){
    	//获得传来的验证码
    	$getcode=$request->input('getcode');
    	$code=\Cookie::get('code');
    	if($getcode==$code && $getcode!=null){
    		return 1;
    	}else{
    		return 0;
    	}

    }

    //密码忘记后的重置密码
    function changepass(Request $request){
    	//return 1111;
    	$res=$request->only('password');
    	// dd($res);
    	$username=$request->session()->get('username');
    	$res['pass']=Hash::make($request->input('password'));
    	$result=DB::table('user')->where('username',$username)->update($res);
    	//dd($result);
		if($result){
			return redirect('home/login/login');
		}else{
			return back();
		}
    }

    //退出登录
    function logout(Request $request){
       // return 11;
        $request->session()->forget('username');
        return redirect('home/home/index');

    }






}
