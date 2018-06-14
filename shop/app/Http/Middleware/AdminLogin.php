<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('adminusername')){
            //调用当前所在的路由方法
            $route=$this->route($request);
            //dd($route);
            if($route){
                return $next($request);
            }else{
                return back()->with('message','无权限访问，请联系管理员');
            }
           


            
        }else{
            return redirect('admin/login/index');
        }
     
    }

    function route($request){
        //得到路由的信息
 /*        +uri: "admin/index/index"
         +action: array:6 [▼
    "middleware" => array:2 [▶]
    "uses" => "App\Http\Controllers\Admin\IndexController@index"
    "controller" => "App\Http\Controllers\Admin\IndexController@index"*/
    //打印$route会得到上面的信息，需要拼接字符串得到当前的路由对应的路由方法，不能直接取uri,因为如果是资源路由，会不一样，要用拼接形式，取部分uri和controller@后面的值，例如index
       $route= $request->route();// 
       //return $route;
       //得到里面controller的字符串信息，
       $controller= $route->action['controller'];
       $arr=explode('@',$controller);
       $str1=$arr[1];
       $uri=$route->uri;
       $arr1=explode('/',$uri);
       $str2=$arr1[0].'/'.$arr1[1];
       //拼接成最后的字符串，例如admin/index/index
       $url= $str2.'/'.$str1;
       //获得当前的登录id用来判断权限
       // $user_id=$request->session()->get('user_id');
       $user_id=session('adminuser_id');
       //return $user_id;从关系表查询对应的角色id
       $role_id=DB::table('user_role')->where('user_id',$user_id)->value('role_id');
       //return $role_id;
       //从权限表查询对应的权限id
       $permission_id=DB::table('role_permission')->where('role_id',$role_id)->pluck('permission_id');
       //return $permission_id;
       $action=[];
       foreach($permission_id as $k=>$v){
            //把对应的action字段的路由方法存到一个数组中
            $action[]=DB::table('permission')->where('permission_id',$v)->value('action');
       }
       //return $action;
       //return $action;
       //判断当前要访问的路由是不是在数组里面，不是说明没权限
       if(in_array($url,$action)){
        return 1;
       }else{
        return 0;
       }






    }



}
