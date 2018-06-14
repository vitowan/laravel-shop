<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CommentController extends Controller
{
    //产品评论列表
    function index(){
    	$res=DB::table('goods_comments')->get();
    	return view('admin.comment.index',['res'=>$res]);
    }
}
