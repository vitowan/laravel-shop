<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GoodsDetailController extends Controller
{
    //商品详情页
    function index($id){
    	//return 1111;当前用户信息
    	$result=DB::table('goods')->where('goods_id',$id)->first();
        //放大镜的一排小图
    	$res=DB::table('goods_pic')->where('goods_picpid',$id)->orderBy('goods_picsort','DESC')->get();
        //商品的评论信息
        $comment=DB::table('goods_comments')->where('goods_id',$id)->paginate(10);
        //dd();
        //好评的信息
        $Gcomment=DB::table('goods_comments')->where('goods_id',$id)->where('comment_score','G')->paginate(10);
        //中评
        $Mcomment=DB::table('goods_comments')->where('goods_id',$id)->where('comment_score','M')->paginate(10);
        //差评
        $Ncomment=DB::table('goods_comments')->where('goods_id',$id)->where('comment_score','N')->paginate(10);
        //面包屑导航
    	$rescate=DB::table('goods')->where('goods_id',$id)->first();
    	$rescate1=DB::table('cate')->where('id',$rescate->goods_pid)->first();
    	$rescate2=DB::table('cate')->where('id',$rescate1->cate_pid)->first();
    	$rescate3=DB::table('cate')->where('id',$rescate2->cate_pid)->first();

        //dd($comment);





    	return view('home.goods.goodsDetail',['result' => $result,'comment'=>$comment,'Gcomment'=>$Gcomment,'Mcomment'=>$Mcomment,'Ncomment'=>$Ncomment,'res'=>$res,'rescate'=>$rescate3->cate_name,'rescate1'=>$rescate2->cate_name,'rescate2'=>$rescate1->cate_name]);


    }
}
