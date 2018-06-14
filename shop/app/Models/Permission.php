<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Permission extends Model
{
    ////权限列表和查询
    function list($request){
    	$search=$request->input('search');
    	$res=DB::table('permission')->where('permission_name','like','%'.$search.'%')->paginate(12);
    	//$res=DB::table('permission')->paginate(12);
    	return $res;
    }
//添加权限时，角色的显示
    function rolelist(){
    	$res=DB::table('role')->get();
    	return $res;
    }

    //执行添加权限
    function mstore($request){
		$permission_name=$request->input('permission_name');
        $action=$request->input('action');
        $role_id=$request->input('role_id');
        //添加权限
       $permission_id= DB::table('permission')->insertGetId(['permission_name'=>$permission_name,'action'=>$action]);//添加到关系表中
        foreach($role_id as $v){
            DB::table('role_permission')->insert(['permission_id'=>$permission_id,'role_id'=>$v]);
        }
       return $permission_id;



    }


}
