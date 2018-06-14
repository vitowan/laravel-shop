<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    //后台登录页面
    function index(){
    	return view('admin.login.index');
    }

    //判断登录
    function login(Request $request){
    	//$res=$request->input();
    	//dd($res);
    	$res=DB::table('user')->where('username',$request->input('username'))->first();

  		if($res){
  			//如果查询到用户名，哈希验证密码
    		if(Hash::check($request->input('password'),$res->pass)){

    			session(['adminusername'=>$request->input('username'),'adminuser_id'=>$res->id]);
    			return redirect('admin/index/index');
    		}else{
    			return back()->with('mes1','密码错误');
    		}

    	}else{
    		//没用户名就返回信息
    		return back()->with('mes','用户名不存在');

    	}
    	
    	
    }
    //退出登录
    function out(Request $request){
    	$request->session()->forget('adminusername');
    	return redirect('admin/login/index');
    }


}
