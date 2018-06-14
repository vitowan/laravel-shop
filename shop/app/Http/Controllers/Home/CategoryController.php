<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;//手动分页类需要
use Illuminate\Pagination\Paginator;//手动分页类需要
class CategoryController extends Controller
{
    //产品分类页面
    function index(Request $request,$id){
    	//$data>$res>$result
    	//得到对应id的大数组
		//$res=$this->getAll($id);

    	//得到对应id为0的大数组
    	$data=$this->getAll(0);//所有的层
    	//查询当前id对应的pid
    	$pid=DB::table('cate')->where('id',$id)->value('cate_pid');
    	//查询对应的当前的id同级的数据
    	$cate_name=DB::table('cate')->where('id',$id)->value('cate_name');
    	//查询当前层id对应的下级的数据
    	//dd($res);
    	$result=$this->getAll($id);
    	//dd($result);
    	//查询对应id的有没有上级
    	$top=DB::table('cate')->where('id',$pid)->first();
      

    	//拼接产品列表

    	if(count($top)){
        $ttop=DB::table('cate')->where('id',$top->cate_pid)->first();
        if(!count($ttop)){
        //如果有上面只有一层级
          $categoods=[];
          foreach($result as $v){
            foreach($v->goods as $vv){
              
            $categoods[]=$vv;
              
            }

          }
          $current_page=$request->input('page')?$request->input('page'):1;
          $total=count($categoods);
          if($total){
            $perPage=8;
            //切割数组，三个值：数组，从哪开始，切几个
            $items=array_slice($categoods,($current_page-1)*$perPage,$perPage);
            //实例化时传的几个值
            // dd($items);
            $page=new LengthAwarePaginator($items, $total, $perPage,$current_page, [
              'path' => Paginator::resolveCurrentPath()]);//最后一个数组里面是定个分页的地址，如果不写，分页地址会跳转错误
            // dd($page);
            $html=$page->links();//此步也可以直接用到模板中用{{}}包起来  
            return view('home.category.index',['data'=>$data,'id'=>$id,'cate_name'=>$cate_name,'result'=>$result,'dis'=>"display:none",'categoods'=>$items,'html'=>$html]);
          }          
          
        }else{
            $categoods=DB::table('goods')->where('goods_pid',$id)->get()->toArray();
            //dd($categoods);
            $current_page=$request->input('page')?$request->input('page'):1;
            $total=count($categoods);
            if($total){
                 $perPage=8;
                //切割数组，三个值：数组，从哪开始，切几个
                $items=array_slice($categoods,($current_page-1)*$perPage,$perPage);
                //实例化时传的几个值
                // dd($items);
                $page=new LengthAwarePaginator($items, $total, $perPage,$current_page, [
                  'path' => Paginator::resolveCurrentPath()]);//最后一个数组里面是定个分页的地址，如果不写，分页地址会跳转错误
                // dd($page);
                 $html=$page->links();//此步也可以直接用到模板中用{{}}包起来    
                // dd($html);
                // dd($categoods);
                return view('home.category.index',['data'=>$data,'id'=>$id,'cate_name'=>$cate_name,'result'=>$result,'dis'=>"display:none",'categoods'=>$items,'html'=>$html]);     
            }else{

                $html='没有查询到相关内容';
                return view('home.category.index',['data'=>$data,'id'=>$id,'cate_name'=>$cate_name,'result'=>$result,'dis'=>"display:none",'categoods'=>$categoods,'html'=>$html]);//最后传了search搜索的内容传到模板的value  
            }            
          
        }

      }else{
  		//没上级
  		$categoods=[];
    	foreach($result as $v){
    		foreach($v->child as $vv){
    			foreach($vv->goods as $vvv){
					$categoods[]=$vvv;
				  }
    		}
    	}
    	//dd($categoods);
      $current_page=$request->input('page')?$request->input('page'):1;
      //得到多少条数据
      $total=count($categoods);
      if($total){
           $perPage=8;
          //切割数组，三个值：数组，从哪开始，切几个
          $items=array_slice($categoods,($current_page-1)*$perPage,$perPage);
          //实例化时传的几个值
          // dd($items);
          $page=new LengthAwarePaginator($items, $total, $perPage,$current_page, [
            'path' => Paginator::resolveCurrentPath()]);//最后一个数组里面是定个分页的地址，如果不写，分页地址会跳转错误
          // dd($page);
           $html=$page->links();//此步也可以直接用到模板中用{{}}包起来    
          // dd($html);
          // dd($categoods);
          return view('home.category.index',['data'=>$data,'id'=>$id,'cate_name'=>$cate_name,'result'=>$result,'dis'=>"display:block",'categoods'=>$items,'html'=>$page]);     
      }else{

          $html='没有查询到相关内容';
          return view('home.category.index',['data'=>$data,'id'=>$id,'cate_name'=>$cate_name,'result'=>$result,'dis'=>"display:block",'categoods'=>$categoods,'html'=>$html]);//最后传了search搜索的内容传到模板的value  
      }



  		

  	}

    }


    //遍历把不同分类的id的对应的产品放到一个一维数组
    function getGoods($id){
    	$categoods=[];
    	$allgoods=$this->getAll($id);
    	//DB::table('cate')->where('')->get();
    	foreach ($allgoods as $v){
    		foreach($v->child as $vv){
    			foreach($vv->goods as $vvv){
    				$categoods[]=$vvv;
    			}
    		}
    	}
    	return $categoods;

    }



    //遍历组成一个多层的大数组
    function getAll($id){
    	$data=DB::table('cate')->where('cate_pid',$id)->get();
    	foreach($data as $k=>$v){  		
    		$data[$k]->goods=DB::table('goods')->where('goods_pid',$v->id)->get();
    		$v->child=$this->getAll($v->id);

    	}
    	return $data;

    }

    //处理分类页面ajax传来的值
   function cateclick(Request $request){
    	// return 1111;
     	//得到传来的值
    	$id=$request->input('id');  	
    	//判断类别中有没有子级
    	$categoods=[];
   		$bottom=DB::table('cate')->where('cate_pid',$id)->first();
   		//如果有子级把所有goods放到一个一维数组
   		if(count($bottom)>0){
   			$allgoods=$this->getAll($id);
   			//return $allgoods;
   			foreach($allgoods as $v){
   				foreach($v->goods as $vv){
   					$categoods[]=$vv;
   				}
   			}
   			return $categoods;

   		}else{
   			//如果没子级说明是最后一层分类
   			//$allgoods=$this->getAll($id);
   			//return $allgoods;
   			$categoods=DB::table('goods')->where('goods_pid',$id)->get();
   			return $categoods;

   		}

    }





}
