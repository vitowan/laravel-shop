<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //权限列表
       //dd($search);
        $perm=new Permission;
        $result=$perm->list($request);

        return view('admin.permission.index',['result'=>$result,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加权限
        $res=new Permission;
        $result=$res->rolelist();
        //dd($result);
        return view('admin/permission/create',['res'=>$result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加权限
        $res=new Permission;
        $result=$res->mstore($request);
        if($result){
            return redirect('admin/permission');
        }else{
            return back();
        }

        //dd($res);



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
        //更改权限
        //找到对应的权限
        $res=DB::table('permission')->where('permission_id',$id)->first();
        //dd($res);
        //找到对应的角色
        $role=DB::table('role')->get();
        //从关系表中找到对应的角色id
        $role_id=DB::table('role_permission')->where('permission_id',$id)->pluck('role_id');
        //dd($role_id);
        foreach($role as $k=>$v){
            foreach($role_id as $vv){
                if($v->role_id==$vv){
                    $v->checked=1;
                }
            }
        }
        //dd($role);

        return view('admin.permission.edit',['res'=>$res,'role'=>$role]);
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
        //执行权限更改
        //return $id;
        $res=$request->only(['permission_name','action']);
        $role_id=$request->input('role_id');
        //更改权限
        //dd($role_id);
        $result=DB::table('permission')->where('permission_id',$id)->update($res);
        //更改关系表，先删除，再添加
        $del=DB::table('role_permission')->where('permission_id',$id)->delete();
        $permission=[];
        foreach($role_id as $v){
            $permission['permission_id']=$id;
            $permission['role_id']=$v;
            DB::table('role_permission')->insert($permission);
        }
        //dd($permission);
        return redirect('admin/permission');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除权限
        //return $id;
        $res=DB::table('permission')->where('permission_id',$id)->delete();
        if($res){
            $result=DB::table('role_permission')->where('permission_id',$id)->delete();
            if($result){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}
