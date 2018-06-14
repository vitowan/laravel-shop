<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //角色列表
        $res=DB::table('role')->paginate(12);
        return view('admin.role.index',['result'=>$res]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加角色页面
        $res=DB::table('permission')->get();
        return view('admin.role.create',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行添加角色
        $role_name=$request->input('role_name');
        $permission_id=$request->input('permission_id');
        //添加角色
        $role_id=DB::table('role')->insertGetId(['role_name'=>$role_name]);
        //dd($permission_id);
        //添加关系表
        foreach($permission_id as $v){
            DB::table('role_permission')->insert(['role_id'=>$role_id,'permission_id'=>$v]);
        }
        return redirect('admin/role');

        
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
        //return $id;所有权限
        $res=DB::table('permission')->get();
        //当前角色名
        $role_name=DB::table('role')->where('role_id',$id)->value('role_name');
        //找到已经选中的权限id
        $permission_id=DB::table('role_permission')->where('role_id',$id)->pluck('permission_id');
        //dd($permission_id);
        //dd($res);
        //把权限中已经被选中的加个属性checked=1,然后让末班中为1的选中
        foreach($res as $k=>$v){
            foreach($permission_id as $kk=>$vv){
                if($v->permission_id==$vv){
                    $res[$k]->checked=1;
                }
            }
        }
        return view('admin.role.edit',['res'=>$res,'role_name'=>$role_name,'role_id'=>$id]);
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
        //执行更改
        $role_name=$request->input('role_name');
        //dd($role_name);

        $permission_id=$request->input('permission_id');
        //dd($role_id);
        //dd($permission_id);

        //更改角色名
        DB::table('role')->where('role_id',$id)->update(['role_name'=>$role_name]);        
        //更改权限，先删除之前的权限，再重新添加即可
        $res=DB::table('role_permission')->where('role_id',$id)->delete();
        //dd($res);
        
        foreach($permission_id as $v){
            DB::table('role_permission')->insert(['role_id'=>$id,'permission_id'=>$v]);
        }   
        return redirect('admin/role');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除角色
        $res=DB::table('role')->where('role_id',$id)->delete();
        if($res){
            $result=DB::table('role_permission')->where('role_id',$id)->delete();
            if($result){
                return 1;
            }else{
                return 0;
            }
        }else{
            return 0;
        }
        
    }

//权限分配页面
    function perm_assign($id){
        //return $id;所有权限
        $res=DB::table('permission')->get();
        //当前角色名
        $role_name=DB::table('role')->where('role_id',$id)->value('role_name');
        //找到已经选中的权限id
        $permission_id=DB::table('role_permission')->where('role_id',$id)->pluck('permission_id');
        //dd($permission_id);
        //dd($res);
        //把权限中已经被选中的加个属性checked=1,然后让末班中为1的选中
        foreach($res as $k=>$v){
            foreach($permission_id as $kk=>$vv){
                if($v->permission_id==$vv){
                    $res[$k]->checked=1;
                }
            }
        }
        //dd($res);
    

        return view('admin.role.assign',['res'=>$res,'role_name'=>$role_name,'role_id'=>$id]);
    }
    //执行权限分配
    function doassign(Request $request){
        //return 111;
        $role_id=$request->input('role_id');
        $permission_id=$request->input('permission_id');
        //dd($role_id);
        //dd($permission_id);
        //先删除之前的权限，再重新添加即可
        $res=DB::table('role_permission')->where('role_id',$role_id)->delete();
        //dd($res);
        
        foreach($permission_id as $v){
            DB::table('role_permission')->insert(['role_id'=>$role_id,'permission_id'=>$v]);
        }
        return redirect('admin/role');

    }




}
