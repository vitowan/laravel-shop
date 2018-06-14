<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MESSAGEXsend;
use DB;
use Illuminate\Support\Facades\Hash;
class RegController extends Controller
{
    //注册
    function reg(){
    	//return  111;
    	return view('home.reg.index');
    }

    //接收ajax提交过来的电话，并进行处理
    function getcode(Request $request){
    	$phone=$request->input('phone');
    	//$code=rand(1001,9999);
    	//return $phone;
    	\Cookie::queue('code',11,1);
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
    }
    //执行提交的注册
    function doreg(Request $request){
    	//return 1111;
    	//得到输入的code值
    	$rescode=$request->input('code');
    	$data=$request->except(['_token','code']);
    	$data['pass']=Hash::make($request->input('password'));
       $data['group_id']=110;
       //dd($data);
    	//获得发送验证码后设置的本地的cookie值
    	$code=\Cookie::get('code');
    	if($rescode==$code && $rescode!=null){
    		//插入数据
    		$res=DB::table('user')->insert($data);
    		if($res){
    			return redirect('home/login/login');
    		}else{
    			$Request->flashOnly('phone');
    			return back()->with();
    		}

    	}else{
    		return back()->with('mes','验证码有误');
    		//return 111;

    	}

    }




}
