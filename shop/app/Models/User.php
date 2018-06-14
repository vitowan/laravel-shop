<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Hash;
//引入图片处理类
use  Intervention\Image\ImageManager;
class User extends Model
{
    //用户列表
    function getAll($request){
    	$search=$request->input('search');
    	$res=DB::table('user')->where('username','like','%'.$search.'%')->paginate(5);
    	return $res;
    }
    //添加用户
    function inserts($request,$url){
    	//获得需要的数据
    	$data=$request->except(['_token','pic','role_id']);
    	//获得hash密码
        $data['pass']=Hash::make($request->input('password'));
    	//以下处理图片
/*    	if($request->hasFile('pic')){

    		$picname=date('Ymd').rand(0,999999);
    		$ext=$request->pic->getClientOriginalExtension();
    		$pic='uploads/'.$picname.'.'.$ext;
    		$request->pic->move('uploads/',$pic);
    		//实例化图片处理类
    		$image = new ImageManager;
    		//处理图片大小并保存
    		$img=$image->make($pic)->resize(100,100)->save($pic);
    		if($img){
    			//图片路径放到数组
				$data['pic']=$pic;
    		}else{
    			unlink($pic);
    		}
    	}else{
    		$data['pic']='';
    	}*/

    	//插入数据
        $data['pic']=$url;
        //得到当前的角色id,然后数据插入到用户角色关系表
        $role_id=$request->input('role_id');
		$id=DB::table('user')->insertGetId($data);
        $res=DB::table('user_role')->insert(['user_id'=>$id,'role_id'=>$role_id]);
		return $res;    	

    }
	//删除用户
	function del($id){
		$pic=DB::table('user')->where('id',$id)->value('pic');
		$data=DB::table('user')->where('id',$id)->delete();
		if($data){
			if(file_exists($pic)){
				unlink('.'.$pic);
			}

		}

		return $data;
	}

	//更改用户页面
	function edit($id){
		//获得当前对应id的数据
		$res=DB::table('user')->where('id',$id)->first();
		//dd($res);
		return $res;
	}
	//处理更改用户
	function doUpdate($request,$id,$url){
		$oldpic=DB::table('user')->where('id',$id)->value('pic');
		$res=$request->except(['_token','_method','pic','role_id']);
		//添加hash密码
        $res['pass']=Hash::make($request->input('password'));

		//处理图片
    	if($request->hasFile('pic')){
/*
    		$picname=date('Ymd').rand(0,999999);
    		$ext=$request->pic->getClientOriginalExtension();
    		$pic='uploads/'.$picname.'.'.$ext;
    		$request->pic->move('uploads/',$pic);
    		//实例化图片处理类
    		$image = new ImageManager;
    		//处理图片大小并保存
    		$img=$image->make($pic)->resize(100,100)->save($pic);*/
    			//图片路径放到数组
			$res['pic']=$url;
            if($oldpic){
                unlink('.'.$oldpic);
            }
            

    	}else{
    		$res['pic']=$oldpic;
    	}
    	//添加到数据库
        $role_id=$request->input('role_id');
        DB::table('user_role')->where('user_id',$id)->update(['role_id'=>$role_id]);
    	$result=DB::table('user')->where('id',$id)->update($res);
    	return $result;		
	}









}
