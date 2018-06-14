<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use Illuminate\Pagination\LengthAwarePaginator;//手动分页类需要
use Illuminate\Pagination\Paginator;//手动分页类需要
use DB;
use  Intervention\Image\ImageManager;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //显示分类列表

        $res=new cate();
        //调用，获得model里传来的所有值值
        $result1=$res->getAll($request);
        //调用model里面的递归函数，得到一个二维数组
        $result=$res->cate_list($result1);

        //从数组取数据后，手动分页
        $current_page=$request->input('page')?$request->input('page'):1;
/*        if ($request->has('page')) {
            $current_page = $request->input('page');
            $current_page = $current_page <= 0 ? 1 :$current_page;
        } else {
            $current_page = 1;
        }*/
        //得到多少条数据
        $total=count($result);
        //如果查询到结果，则分页，否者不分页，直接输出提示
        if($total){
             $perPage=10;
            //切割数组，三个值：数组，从哪开始，切几个
            $items=array_slice($result,($current_page-1)*$perPage,$perPage);
            //实例化时传的几个值
            $page=new LengthAwarePaginator($items, $total, $perPage,$current_page, [
            'path' => Paginator::resolveCurrentPath()]);//最后一个数组里面是定个分页的地址，如果不写，分页地址会跳转错误
            $html=$page->appends(['search'=>$request->input('search')])->links();//此步也可以直接用到模板中用{{}}包起来    
            
            return view('admin.cate.index',['items'=>$items,'html'=>$html,'search'=>$request->input('search')]);//最后传了search搜索的内容传到模板的value       
        }else{

            $html='没有查询到相关内容';
            return view('admin.cate.index',['items'=>[],'html'=>$html,'search'=>$request->input('search')]);//最后传了search搜索的内容传到模板的value  
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //显示添加分类页面
        $res=new cate;
        //调用，获得model里传来的所有值值
        $result1=$res->getAll($request);
        //调用model里面的递归函数，得到一个二维数组
        $result=$res->cate_list($result1);
        if(count($result)){//如果已经有数据，传过去result
            return view('admin.cate.create',['result'=>$result]);        
        }else{//如果没数据传过去空数组
            return view('admin.cate.create',['result'=>[]]);        
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //处理添加分类
        $res=new cate;
        $result=$res->inserts($request);  
        if($result){
            return redirect('admin/cate');
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
    public function edit(Request $request,$id)
    {
        //更改页面展示
        $res=new cate;
        //调用，获得model里传来的所有值值
        $result1=$res->getAll($request);
        //调用model里面的递归函数，得到一个二维数组
        $result=$res->cate_list($result1);
        $data=$res->editor($id);
        return view('admin.cate.edit',['result'=>$result,'data'=>$data]);
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
        //处理更改分类
        $res=new cate;
        $result=$res->doupdate($request,$id);
        if($result){
            return redirect('admin/cate');
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
        //删除分类
        $res=new cate;
        $result=$res->del($id);
        if($result==1){
            return 1;
        }elseif($result==0){
            return 0;
        }else{
            return 2;
        }

    }

    //主分类广告图管理页面
    function cate_pic(){
        $res=DB::table('cate')->where('cate_pid',0)->get();
        foreach($res as $v){
            $v->cate_pic=DB::table('cate_pic')->where('cate_picpid',$v->id)->get();
        }
        //dd($res);
        
        return view('admin.cate.catepic',['res'=>$res]);
    }

    //主分类图添加执行
    function cate_picadd(Request $request){
        $id= $request->input('id');//对应的分类id
        $res=$request->file('cate_picurl');//上传的图片对象
        //dd($id);
        if($request->hasFile('cate_picurl')){

            $cate_pic=$request->file('cate_picurl');
             //多图上传
            foreach($cate_pic as $v){
                $picname=date('Ymd').rand(0,999999);
                $ext=$v->getClientOriginalExtension();
                $pic='/uploads/goodsimg/'.$picname.'.'.$ext;
                $v->move('uploads/goodsimg',$picname.'.'.$ext);
                //实例化图片处理类
                $image = new ImageManager;
                //处理图片大小并保存
                $img=$image->make('.'.$pic)->resize(300,560)->save('.'.$pic);
                if($img){
                    //图片路径放到数组
                    $data['cate_picurl']=$pic;
                    $data['cate_picpid']=$id;
                    //插入数据
                    $res=DB::table('cate_pic')->insert($data);

                }else{//如果图片剪裁失败，就删除
                    unlink('.'.$pic);

                }            
            }
            //foreach循环成功跳转
            return redirect('admin/catepic/cate_pic');


        }else{
            return back()->with('mes','请选择图片');
        }

    }
    //主分类图删除
    function cate_picdel(Request $request){
        //return 111;
        //接收的id
        $cate_picid=$request->input('cate_picid');
        //对应的pid
        $cate_picpid=DB::table('cate_pic')->where('cate_picid',$cate_picid)->value('cate_picpid');
        $cate_pic=DB::table('cate')->where('id',$cate_picpid)->value('cate_pic');
        //return $cate_picid;
        //当前的图片
        $cate_picurl=DB::table('cate_pic')->where('cate_picid',$cate_picid)->value('cate_picurl');
        if(file_exists('.'.$cate_picurl)){
            if($cate_pic==$cate_picurl){
            return 2;
            }else{
                //删除图片
                unlink('.'.$cate_picurl);
               
                $res=DB::table('cate_pic')->where('cate_picid',$cate_picid)->delete();
                if($res){
                    return 1;
                }else{
                    return 0;
                } 

            }
        }else{
            $res=DB::table('cate_pic')->where('cate_picid',$cate_picid)->delete();
            if($res){
                return 1;
            }else{
                return 0;
            }
        }
        

    }

    function cate_picsort(Request $request,$id){
        $res=$request->input();
        //dd($res);为图片排序
        foreach($res as $k=>$v){
            $ressort=DB::table('cate_pic')->where('cate_picid',$k)->where('cate_picpid',$id)->update(['cate_picsort'=>$v]);
        }
        //找到所有的排序号组成的数组
        $cate_picsort= DB::table('cate_pic')->where('cate_picpid',$id)->select('cate_picsort')->get();
        //找到最大的序号
        $sort=[];
        foreach($cate_picsort as $k=>$v){
            $sort[]=$v->cate_picsort;
        }
        //dd($sort);
        $cate_picurl=DB::table('cate_pic')->where('cate_picpid',$id)->where('cate_picsort',max($sort))->value('cate_picurl');
        //把最大序号对应的图片更新到分类里面
        $result=DB::table('cate')->where('id',$id)->update(['cate_pic'=>$cate_picurl]);
        if($result!==false){
            return redirect('admin/catepic/cate_pic');
        }else{
            return back()->with('mes','设置失败');
        }
        
    }






}
