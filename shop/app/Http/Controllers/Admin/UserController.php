<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\User;
use DB;

//引入图片处理类
use  Intervention\Image\ImageManager;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //用户列表
        $res=new User();
        $result=$res->getAll($request);
        return view('admin.user.index',['result'=>$result,'request'=>$request,'search'=>$request->input('search')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加用户
        $role=DB::table('role')->get();
        return view('admin.user.create',['role'=>$role]);
    }


     //用户上传时的缩略图的处理
    function user_thumb(Request $request){
        //return $_FILES;

        if($request->session()->has('path')){
           // 得到session值
            $url=$request->session()->get('path');            
            if(file_exists('.'.$url)){//如果有图片
                unlink('.'.$url);//删除图片,删除图片用相对路径:./uploads/userimg/2018041528457.jpg                
            }

            $a=$request->session()->forget('path');
            //return $a;
        }
        $file=$request->file('file_data');
        $name = date('Ymd').rand(0,99999);
        //获取后缀名
        $ext = $file->getClientOriginalExtension();
        $picname = $name.'.'.$ext;

       $data=$file->move('uploads\userimg',$picname);
       $path='/uploads/userimg/'.$picname;

       if($data){
            session(['path'=>$path]);
       }

       return $path;
    }
       

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //处理添加用户前的表单验证
        $this->validate($request,[
            'username'=>'required|regex:/\w{3,20}/',
            'password'=>'required|regex:/\w{3,20}/',
            'phone'=>'required|regex:/\d{11}/'
        ],[ 
            'username.required'=>'用户名不能为空',
            'username.regex'=>'用户名必须有3~20位数字，或字母下划线组成',
            'password.required'=>'密码不能为空',
            'password.regex'=>'用户名必须有3~20位数字，或字母下划线组成',
            'phone.required'=>'手机号不能为空',
            'phone.regex'=>'请输入正确的手机号码',

        ]);
        //处理添加用户
        $res=new User();
        if($request->session()->has('path')){
            $url=$request->session()->get('path');
        }else{
            $url=null;
        }
        $result= $res->inserts($request,$url);

        if($result){
            $request->session()->forget('path');
            return redirect('admin/user');
        }else{
            return back();
        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //更改页面
        $res=new User();
        $result=$res->edit($id);
        $role=DB::table('role')->get();
        $user_id=$result->id;
        $role_id=DB::table('user_role')->where('user_id',$user_id)->value('role_id');
        return view('admin.user.edit',['result'=>$result,'role'=>$role,'role_id'=>$role_id]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //处理更改用户
        //获得路径
         if($request->session()->has('path')){
            $url=$request->session()->get('path');
        }else{
            $url=null;
        }     
        $res=new User();
        //路径传过去
        $result=$res->doUpdate($request,$id,$url);  
        if($result){
            return redirect('admin/user');
        }else{
            return back();
        }   


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
        $res=new User();
        $data=$res->del($id);
        if($data){
            return 1;
        }else{
            return 0;
        }
    }
}
