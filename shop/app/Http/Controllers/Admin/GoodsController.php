<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Cate;
use DB;
use  Intervention\Image\ImageManager;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //产品列表
        $res=new goods;
        $result=$res->getAll();

        //给每个产品的组加上一个属性，属性是产品类拼接成的字符串
        foreach($result as $k=>$v){
            //$v->catename=DB::table('cate')->where('id',$v->goods_pid)->value('cate_name');
            $res=DB::table('cate')->where('id',$v->goods_pid)->first();//$res->cate_name
            $res1=DB::table('cate')->where('id',$res->cate_pid)->first();//$res1->cate_name
            $res2=DB::table('cate')->where('id',$res1->cate_pid)->first();//$res2->cate_name
            //拼接
            $v->catename=$res2->cate_name.' => '.$res1->cate_name.' => '.$res->cate_name;

        }
        //dd($result);

        return view('admin.goods.index',['result'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //添加产品页面
        $res=new Cate;
        //获得所有分类
        $result=$res->getAll($request);
        //调用递归函数，放到多层大数组里面
        $data=$res->cate_arrlist($result);
        //dd($data);


        return view('admin.goods.create',['data'=>$data]);
    }

    //显示第二和第三层下拉菜单的方法
    public function createselect(Request $request){
        //return $_POST['id'];
        $res=DB::table('cate')->where('cate_pid',$request->input('id'))->get();
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //处理添加产品
        //dd( $request->input());
/*        $this->validate($request,[
            'goods_name'=>'required',
            'goods_brand'=>'required',
            'goods_price'=>'required|regex:/^([1-9][0-9]{0,9})(\.[0-9]{1,2})?$/',
           'goods_sales'=>'required|regex:/\d{1,10}/',
            'goods_inventory'=>'required|regex:/\d{1,10}/',
            'goods_pid'=>'required'
        ],[ 
            'goods_name.required'=>'产品名不能为空',
            'goods_brand.required'=>'品牌名不能为空',
            'goods_price.required'=>'产品价格不能为空',
            'goods_price.regex'=>'产品价格只能填写数字，整数位最多10位，且整数位必须大于1，小数部分最多2位',
            'goods_sales.required'=>'产品销量必须填写',
            'goods_inventory.required'=>'产品库存必须填写',
            'goods_inventory.regex'=>'产品库存不能为空，可以填写0，或者10位及以内的数字',
            'goods_pid.required'=>'请选择详细的分类',

        ]);*/
        $res=new Goods;
        $result=$res->inserts($request);
        if($result){
            return redirect('admin/goods');
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
        //return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {

        //产品更改
        $res=new Cate;
        //获得所有分类
        $result=$res->getAll($request);
        //调用递归函数，放到多层大数组里面
        $data=$res->cate_arrlist($result);
        //model里面产品类实例化
        $res1=new Goods;
        $result=$res1->editor($id);
       // dd($result);

        $result1=DB::table('cate')->where('id',$result->goods_pid)->first();
        $result2=DB::table('cate')->where('id',$result1->cate_pid)->first();
        $result3=DB::table('cate')->where('id',$result2->cate_pid)->first();
        return view('admin.goods.edit',['result'=>$result,'data'=>$data,'result1'=>$result1,'result2'=>$result2,'result3'=>$result3]);
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
        //处理产品更改


        $this->validate($request,[
            'goods_name'=>'required',
            'goods_brand'=>'required',
            'goods_price'=>'required|regex:/^([1-9][0-9]{0,9})(\.[0-9]{1,2})?$/',
           'goods_sales'=>'required|regex:/\d{1,10}/',
            'goods_inventory'=>'required|regex:/\d{1,10}/',
            'goods_pid'=>'required'
        ],[ 
            'goods_name.required'=>'产品名不能为空',
            'goods_brand.required'=>'品牌名不能为空',
            'goods_price.required'=>'产品价格不能为空',
            'goods_price.regex'=>'产品价格只能填写数字，整数位最多10位，且整数位必须大于1，小数部分最多2位',
            'goods_sales.required'=>'产品销量必须填写',
            'goods_inventory.required'=>'产品库存必须填写',
            'goods_inventory.regex'=>'产品库存不能为空，可以填写0，或者10位及以内的数字',
            'goods_pid.required'=>'请选择详细的分类',

        ]);       
        $res=new Goods;
        $result=$res->doupdate($request,$id);
        //return $result;
       if($result){
            return redirect('admin/goods');
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
        //删除产品
        $res=new Goods;
        $result=$res->del($id);
        return $result;
    }

/*    function findgoodscate($pid){
 //$cate_namestring='';
        $arr=[];
        $data=DB::table('cate')->where('id',$pid)->first();
        //$data=$data->cate_name;
        $arr=$data;
        $this->findgoodscate($data->cate_pid);
        return $arr;

    }*/



    //单个产品的图片管理
    function goods_picmana($id){
        //return $id;
        
/*        $data=DB::table('cate')->get();

        $res=DB::table('goods')->where('goods_id',$id)->first();
        
        foreach($data as $k=>$v){
            $res->goodsname=DB::table('cate')->where('id',$res->goods_pid)->value('cate_name');
        }
        dd($res);*/
//找到一串分类名字
        $res=DB::table('goods')->where('goods_id',$id)->first();
        $res1=DB::table('cate')->where('id',$res->goods_pid)->first();
        $res2=DB::table('cate')->where('id',$res1->cate_pid)->first();
        $res3=DB::table('cate')->where('id',$res2->cate_pid)->first();
        $catename=$res3->cate_name.' => '.$res2->cate_name.' => '.$res1->cate_name.'=>'.$res->goods_name;

        //查找对应id的图片
        $result=DB::table('goods_pic')->where('goods_picpid',$id)->get();
        // dd($result);
        return view('admin.goods.picmana',['result'=>$result,'id'=>$id,'catename'=>$catename]);

    }
    //单个产品的图片删除
    function goods_picdel(Request $request){
        //return 111;
        $goods_picid=$request->input('goods_picid');
        //当前的图片路径
        $path=DB::table('goods_pic')->where('goods_picid',$goods_picid)->value('goods_picurl');
        //产品对应图片表的pid
        $goods_picpid=DB::table('goods_pic')->where('goods_picid',$goods_picid)->value('goods_picpid');
        //return $path;
        //return $goods_picid;
        //产品里面的产品缩略图
        $goods_pic=DB::table('goods')->where('goods_id',$goods_picpid)->value('goods_photo');
        //return $path;
        //return $goods_pic;
        //return(file_exists($path));
        if(file_exists('.'.$path)){
            //如果图片存在，删除图片
            if($path==$goods_pic){
                return 2;
                
           }else{
                $res=unlink('.'.$path);
                //return $res;
                if($res){
                    //如果图片删除成功，删除数据
                   $result=DB::table('goods_pic')->where('goods_picid',$goods_picid)->delete(); 
                   if($result){
                    //数据删除成就返回列表页
                        return 1;//成功就返回列表页   
                        //return redirect('admin/goodspic/goods_picmana/'.$goods_picpid);                                 
                    }else{
                        return 0;
                    }           
                }
            }
                        
        }else{
            //如果图片不存在，直接删除数据
            $r=DB::table('goods_pic')->where('goods_picid',$goods_picid)->delete();
            if($r){
                //如果删除数据成功就返回
                return 1;  
            }else{
                return 0;               
            }             
        }

    }

    //每个产品添加图片
    function goods_picadd(Request $request,$id){
        //return 111;
        $data=$request->only(['goods_picpid']);
        if($request->hasFile('goods_picurl')){
            //多图上传
            foreach($request->goods_picurl as $v){
                $picname=date('Ymd').rand(0,999999);
                $ext=$v->getClientOriginalExtension();
                $pic='/uploads/goodsimg/'.$picname.'.'.$ext;
                $v->move('uploads/goodsimg',$picname.'.'.$ext);
                //实例化图片处理类
                $image = new ImageManager;
                //处理图片大小并保存
                $img=$image->make('.'.$pic)->resize(800,800)->save('.'.$pic);
                if($img){
                    //图片路径放到数组
                    $data['goods_picurl']=$pic;
                    //插入数据
                    $res=DB::table('goods_pic')->insert($data);

                    //dd($res);
/*                    if($res){
                        return redirect('admin/goodspic/goods_picmana/'.$id); 

                    }else{
                        return back()->with('mes','图片上传成功，但数据添加失败');
                    }*/

                }else{
                    unlink('.'.$pic);

                }            
            }
            //foreach循环成功跳转
            return redirect('admin/goodspic/goods_picmana/'.$id);

        }else{
            //没上传图片给提示
            return back()->with('mes','请先选择要上传图片');
        }


    }

    //单个产品的图片排序
    function goods_picsort(Request $request,$id){
        $res=$request->except('_token');
       //var_dump($res);
        foreach($res as $k=>$v){
            DB::table('goods_pic')->where('goods_picid',$k)->update(['goods_picsort'=>$v]); 

        }
            $maxsort=DB::table('goods_pic')->where('goods_picpid',$id)->max('goods_picsort');
            //dd($maxsort);
            $photo=DB::table('goods_pic')->where('goods_picsort',$maxsort)->where('goods_picpid',$id)->value('goods_picurl');
            //dd($photo);
            DB::table('goods')->where('goods_id',$id)->update(['goods_photo'=>$photo]);    



        return redirect('admin/goodspic/goods_picmana/'.$id);

    }


    //单独添加产品介绍页面
    function goods_intro($id){
        //return $id;
        $goods_intro=DB::table('goods')->where('goods_id',$id)->value('goods_intro');
        $goods_name=DB::table('goods')->where('goods_id',$id)->value('goods_name');
        //dd($goods_intro);

        return view('admin.goods.intro',['id'=>$id,'goods_name'=>$goods_name,'goods_intro'=>$goods_intro]);
    }

    //单独处理添加介绍的方法
    function goods_dointro(Request $request,$id){
        //return $id;
        //得到单独的产品介绍的内容
        $res=$request->only(['goods_intro']);
        //把当前id放到数组
        $res['goods_id']=$id;
        $result=DB::table('goods')->where('goods_id',$id)->update($res);
        if($result){
            return redirect('admin/goods');
        }else{
            return back();
        }


        //dd($res);

    }





}
