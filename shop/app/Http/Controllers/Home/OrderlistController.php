<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orderlist;
use DB;

class OrderlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //前台的订单中心页面
        $res=new Orderlist();
        $user_id=$request->session()->get('userid');
        $result=$res->orderlist($user_id);
        //dd($result);
/*        foreach($result as $k=>$v){
            $res1=DB::table('goods_comments')->where('order_id',$v->order_id)->get();
            if(count($res1)>0){
                $v->comment=1;
            }else{
                $v->comment=0;
            }
        }*/
        //dd($result);
        $pay=DB::table('order')->where('order_status',0)->where('user_id',$user_id)->orderBy('order_id','desc')->paginate(6);
        $emit=DB::table('order')->where('order_status',1)->where('user_id',$user_id)->orderBy('order_id','desc')->paginate(6);
        $take=DB::table('order')->where('order_status',3)->where('user_id',$user_id)->orderBy('order_id','desc')->paginate(6);
        $eval=DB::table('order')->where('order_status',4)->where('user_id',$user_id)->where('order_comment',0)->orderBy('order_id','desc')->paginate(6);
/*        $evaluate=[];//把没评论的放进数组
        foreach($eval as $k=>$v){
            if($v->order_comment!=1){
                $evaluate[]=$v;
            }

        }*/
        //dd($eval);


        return view('home.order.orderlist',['result'=>$result,'pay'=>$pay,'emit'=>$emit,'take'=>$take,'eval'=>$eval]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //订单详情
        $res=new Orderlist();
        //对用的订单信息
        $orderres=$res->ordershow($id);
        //对应的订单详情信息
        $orderlistres=$res->orderlistshow($id);
/*        foreach($orderlistres as $k=>$v){
            $r=DB::table('goods_comments')->where('detail_id',$v->detail_id)->get();
            if(count($r)>0){
                $v->comment=1;
            }else{
                $v->comment=0;
            }
        } */
        //dd($orderlistres);

        //DB::table('goods_comment')->where('user_id',$user_id)->where('')


        return view('home.order.orderdetail',['orderres'=>$orderres,'orderlistres'=>$orderlistres]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //未支付变成取消订单
        $res=new Orderlist();
        $result=$res->updateorder($id);
        return $result;

    }
    //点击确认收货变成去评价
    function update1(Request $request, $id){
        $res=new Orderlist();
        $result=$res->updateorder1($request,$id);
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //评论页面
    function comment($id){
        $res=DB::table('order_details')->where('detail_id',$id)->first();
        //dd($res);
        return view('home.order.comment',['res'=>$res]);
        //return 111;
    }

    function docomment(Request $request,$id){
        //$res=$request->input();
       // dd($res);￥request
        $data=[];
        $data['comment_score']=$request->input('comment_score');
        $comment_con=$request->input('comment_con');
        if($comment_con){
            $data['comment_con']=$comment_con;
        }else{
            $data['comment_con']='该买家比较懒，没留下评论内容';
        }
        //当前用户名
        $user_id=$request->session()->get('userid');
        $username=$request->session()->get('username');
        //DB::table('user')->where('id',$user_id)->value('');
        $data['user_id']=$user_id;
        $data['username']=$username;
        $data['detail_id']=$id;
        $data['comment_date']=date('Y-m-d H:i:s');
        $anonym=$request->input('anonym');
        if($anonym==1){
            $data['anonym']=1;
        }else{
            $data['anonym']=0;
        }

        $data['order_id']=$request->input('order_id');

        $data['goods_id']=DB::table('order_details')->where('detail_id',$id)->value('goods_id');

        $data['goods_name']=DB::table('order_details')->where('detail_id',$id)->value('goods_name');
        //dd($data);
        $result=DB::table('goods_comments')->insert($data);
        //把order订单表对应的已评论字段改为1
        DB::table('order')->where('order_id',$request->input('order_id'))->update(['order_comment'=>1]);
        //把订单详情对应的已评论字段改为1
        DB::table('order_details')->where('detail_id',$id)->update(['detail_comment'=>1]);

        if($result){
            return redirect('home/orderlist/'.$request->input('order_id'));
        }else{
            return back();
        }
        

    }




}
