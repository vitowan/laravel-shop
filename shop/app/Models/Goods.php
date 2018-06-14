<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//引入图片处理类
use  Intervention\Image\ImageManager;
use DB;
class Goods extends Model
{	

    //产品列表
    function getALL(){
    	$res=DB::table('goods')->paginate(10);
    	return $res;
    }
    //处理添加产品
    function inserts($request){
    	$res=$request->except(['_token','goods_picpid']);
        //dd($res);

                //以下处理图片
        //dd($request->goods_picpid);
        //图片在另外一个表里，此处先添加数据，再处理图片
        $id=DB::table('goods')->insertGetId($res);
        if($id){//如果数据添加成功
            if($request->hasFile('goods_picpid')){//如果上传了图片
                //挨个处理图片
                foreach($request->goods_picpid as $k=>$v){
                    $picname=date('Ymd').rand(0,999999);
                    $ext=$v->getClientOriginalExtension();
                    $goods_picurl='/uploads/goodsimg/'.$picname.'.'.$ext;
                    //实例化图片处理类
                    //dd($goods_picurl);
                    $image = new ImageManager;
                    //添加图片
                    $v->move('./uploads/goodsimg/',$picname.'.'.$ext);
                    //处理尺寸
                    $img=$image->make('.'.$goods_picurl)->resize(800,800)->save('.'.$goods_picurl);                   
                    if($img){
                        //图片路径放到数组
                        $picdata=['goods_picurl'=>$goods_picurl,'goods_picpid'=>$id];
                        //添加图片的数据
                        DB::table('goods_pic')->insert($picdata);

                    }else{
                        //如果尺寸处理失败，则删除当前添加成功的图片
                        unlink('.'.$goods_picurl);
                    }

                }
                //把排序后的第一张图片作为展示图片
                $photo=DB::table('goods_pic')->where('goods_picpid',$id)->value('goods_picurl');
                DB::table('goods')->where('goods_id',$id)->update(['goods_photo'=>$photo]);

                return 1;   //添加成功有图片返回1  
            }else{
                return 1;//添加成功，没图片返回1               
            }

                   
        }else{
            return 0;//失败

        }


        //插入数据

/*        $id=DB::table('user')->insertGetId($data);
        return $id;   */  


    	//$res=DB::table('goods')->insertGetId($res);
    	//return $res;

    }
    //删除产品
    function del($id){
    	$res=DB::table('goods')->where('goods_id',$id)->delete();
        //查找对应的图片的表信息
        $info=DB::table('goods_pic')->where('goods_picpid',$id)->get();
      //return $info;
        if($res){
            //
            if($info){
                foreach($info as $v){
                    //删除图片
                    unlink('.'.$v->goods_picurl);
                }
                //删除图片表对应的数据
                $res1=DB::table('goods_pic')->where('goods_picpid',$id)->delete();
                if($res1){
                    return 1;               
                }                    
            }
            return 1;
        

        }else{
            return 0;
        }

		//return $res;

    }
    //产品更新页面
    function editor($id){
    	
    	$res=DB::table('goods')->where('goods_id',$id)->first();
    	//dd($res);
    	return $res;
    }
    //处理产品更改
    function doupdate($request,$id){
        $res=$request->except(['_token','_method']);

        if($request->input('goods_status')==null){
            $res['goods_status']='0';
        }
        $result=DB::table('goods')->where('goods_id',$id)->update($res);
        return $result;

        

        //dd($res);
    }
}
